<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    use ApiTrait;

    /**
     * @param array|Collection $data
     * @param array|string $msg
     * @param int|Response $code
     * @return JsonResponse
     */
    public function handleResponse(array|Collection $data, array|string $msg, int|Response $code = Response::HTTP_OK): JsonResponse
    {
        $res = [
            'success' => true,
            'data' => $data,
            'message' => $msg,
        ];
        return $this->response($res, $code);
    }

    /**
     * @param $msg
     * @param int|Response $code
     * @return JsonResponse
     */
    public function handleError($msg, int|Response $code = Response::HTTP_OK): JsonResponse
    {
        return $this->error($msg, $code);
    }
}
