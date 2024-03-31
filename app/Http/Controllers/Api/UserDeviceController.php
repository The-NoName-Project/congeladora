<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Notifications\Notification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserDeviceController extends ApiController
{
    public function register(Request $request): JsonResponse
    {
        $request->validate(['expo_token' => 'required|string']);

        try {
            $user = Auth::user();
            if (! $user instanceof User) {
                return $this->handleError(
                    'User not found',
                    Response::HTTP_NOT_FOUND
                );
            }

            if ($user->devices()->where('expo_token', $request->expo_token)->exists()) {
                return response()->json(['message' => 'Device already registered',], Response::HTTP_CONFLICT);
            }


            $user->devices()->create(['expo_token' => $request->expo_token, 'last_used_at' => Carbon::now()]);

            return $this->handleResponse(['message' => 'Device registered successfully',], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->handleError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function send_noti(): JsonResponse
    {
        try {
            $user = Auth::user();
            if (! $user instanceof User) {
                return $this->handleError(
                    'User not found',
                    Response::HTTP_NOT_FOUND
                );
            }

            $devices = $user->devices()->pluck('expo_token')->toArray();

            $notification = new Notification();
            $notification->notification($devices, 'Huevos con arroz', 'This is a test notification');

            return $this->handleResponse(['message' => 'Notification sent successfully',], Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->handleError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
