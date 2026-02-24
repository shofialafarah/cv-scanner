<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function analyzeCV($text)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'http://localhost',
            'X-Title' => 'CV Scanner'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an HR AI. You MUST return ONLY a valid raw JSON object. No explanation. No markdown.'
                ],
                [
                    'role' => 'user',
                    'content' => "Extract from this CV and return JSON with keys:
                name, email, phone, skills (array), summary, score (0-100).

                CV TEXT:
                $text"
                ]
            ],
            'temperature' => 0.2
        ]);

        if (!$response->successful()) {
            dd($response->json()); // sementara buat debug
        }

        $content = $response->json()['choices'][0]['message']['content'] ?? '';

        $content = preg_replace('/```json|```/', '', $content);

        return json_decode(trim($content), true) ?? [];
    }
}
