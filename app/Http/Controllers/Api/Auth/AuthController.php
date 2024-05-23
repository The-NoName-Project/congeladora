<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\Api\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\TeamUserCodes;
use App\Models\User;
use App\Models\UserDevice;
use App\Models\UserTeam;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $request->validated();

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if (!$user instanceof User) {
                    return $this->handleError('User not found', Response::HTTP_NOT_FOUND);
                }
                $this->revokeTokens($user);
                $token = $user->createToken($user->name)->plainTextToken;

                return $this->handleResponse(['user' => $user, 'token' => $token], 'User logged in successfully');
            }

            return $this->handleError('Unauthorised', Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return $this->handleError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function revokeTokens($user): void
    {
        $user->tokens()->delete();
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $request->validated();

            $user = User::create(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'password' => Hash::make($request->password), 'number' => $request->number, 'role_id' => 4]);

            $code = TeamUserCodes::where('code', $request->code)->first();
            $code->used = true;
            $code->save();

            UserTeam::create(['user_id' => $user->id, 'team_id' => $code->team_id]);

            DB::commit();

            $token = $user->createToken($user->name)->plainTextToken;

            return $this->handleResponse(['user' => $user, 'token' => $token], 'User registered successfully', Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->handleError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user instanceof User) {
                return $this->handleError('User not found', Response::HTTP_NOT_FOUND);
            }
            $user_devices = UserDevice::whereUserId($user->id)->get();

            foreach ($user_devices as $device) {
                $device->delete();
            }

            $this->revokeTokens($user);

            return $this->handleResponse([], 'User logged out successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return $this->handleError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
