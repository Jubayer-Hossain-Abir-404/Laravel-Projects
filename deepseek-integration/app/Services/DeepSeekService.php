<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Response as Res;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Illuminate\Support\Facades\Http;

class DeepSeekService
{
    public function __construct()
    {
    }

    public function chat()
    {
        try {
            $apiKey = config('app.deepseek_api_key');
            $api = 'https://api.deepseek.com/chat/completions';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
                ->post($api, [
                    'model' => 'deepseek-chat',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are a helpful LifeStyleassistant.',
                        ],
                        [
                            'role' => 'user',
                            'content' => 'Give me advice 5 lifestyle tips!',
                        ],
                    ],
                    'stream'=> false,
                ]);

            return $response->json();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new InternalErrorException('Internal server error', Res::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
