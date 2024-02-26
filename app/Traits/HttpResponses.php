<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait HttpResponses
{
    public function successResponse(string $message = "Success response", 
                                    string|int $statusCode = 200, 
                                    array|ResourceCollection|JsonResource $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $statusCode,
            'data' => $data
        ], $statusCode);
    }

    public function errorResponse(string $message = "Error response", 
                                  string|int $statusCode = 400, 
                                  array|string $errors = [],
                                  array $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $statusCode,
            'errors' => $errors,
            'data' => $data
        ], $statusCode);
    }
}
