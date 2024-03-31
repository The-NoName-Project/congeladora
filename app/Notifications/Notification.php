<?php

namespace App\Notifications;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Notification extends ApiController
{
    public function notification(array|string $devices, string $title, string $body): JsonResponse
    {
        try {
            $notification = [
                'to' => $devices,
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
            ];

            if (is_array($devices)) {
                $notification['to'] = $devices;
            }

            $client = new Client();
            $client->post('https://exp.host/--/api/v2/push/send', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip, deflate',
                    'Content-Type' => 'application/json',
                ],
                'json' => $notification,
            ]);

            return $this->handleResponse(['message' => 'Notification sent successfully',], Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->handleError('Failed to get user', Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return $this->handleError('Failed to send notification', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
