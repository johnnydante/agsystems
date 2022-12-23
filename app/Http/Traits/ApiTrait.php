<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ApiTrait
{
    public function dataResponse(array $data, int $status = 200): JsonResponse
    {
        return new JsonResponse([
            $data
        ], $status);
    }

    public function messageResponse(string $message, int $status = 200): JsonResponse
    {
        return new JsonResponse([
            $message
        ], $status);
    }

    public function fullResponse(string $message, array $data, int $status = 200): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function exceptionResponse(\Exception $e, bool $withRollback = false): JsonResponse
    {
        if ($withRollback) DB::rollBack();
        Log::error($e->getMessage());
        Log::error($e->getTraceAsString());
        return new JsonResponse([
            'message' => $e->getMessage()
        ], 500);
    }

}
