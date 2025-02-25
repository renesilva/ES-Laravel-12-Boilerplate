<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function testGet(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'GET request successful'
        ]);
    }

    public function testLoggedIn(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'GET request successful'
        ]);
    }

}

