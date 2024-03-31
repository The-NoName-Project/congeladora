<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiTrait
{
    /**
     * @param array|string|Collection $data
     * @param int $code
     * @return JsonResponse
     */
    protected function response(array|string|Collection $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return  response()->json($data, $code);
    }

    /**
     * @param array|string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function error(array|string $message, int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'error'=>$message,
            'code'=>$code],
            $code
        );
    }

    /**
     * @param array|string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function message(array|string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->response(['message'=> $message], $code);
    }
}
