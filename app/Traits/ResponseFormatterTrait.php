<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * Trait ResponseFormatterTrait
 * @package App\Traits
 */
trait ResponseFormatterTrait
{
    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public static function responseSuccess(string $message = 'success', mixed $data = null, $status = Response::HTTP_OK): JsonResponse
    {
        $responseData = ['message' => $message];

        if ($data) {
            data_set($responseData, 'result', $data);
        }

        return response()->json($responseData, $status);
    }


    /**
     * @param mixed $data
     * @param $statusCode
     * @param string $message
     * @return JsonResponse
     */

    public static function responseError(string $message = 'error', mixed $error = null, $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $responseData = ['message' => $message];

        if ($error) {
            data_set($responseData, 'errors', $error);
        }

        return response()->json($responseData, $status ?: Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param mixed $data
     * @return JsonResponse
     */

    public static function responseWithPagination(mixed $data): JsonResponse
    {
        $jsonResponse = $data->resource->toArray();

        $newJsonResponseData = Arr::only($jsonResponse, ['data']);
        $newJsonResponseMeta = Arr::only($jsonResponse, ['current_page', 'from', 'last_page', 'per_page', 'to', 'total']);

        return response()->json(['result' => $newJsonResponseData + ['meta' => $newJsonResponseMeta]] + $data->additional, Response::HTTP_OK);
    }
}
