<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeepSeekService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as Res;

class DeepseekController extends Controller
{
    public function __construct(private DeepSeekService $service)
    {
    }

    public function chat(): JsonResponse
    {
        return response()->json([
            'message' => 'Deepseek chat generated successfully',
            'data' => $this->service->chat(),
        ], Res::HTTP_CREATED);
    }
}
