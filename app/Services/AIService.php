<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function analyzeCV($text, $requiredSkills = [])
    {
        $skillString = implode(', ', $requiredSkills);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'http://localhost',
            'X-Title' => 'CV Scanner'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an HR AI expert. You MUST return ONLY a valid raw JSON object. No explanation. No markdown.'
                ],
                [
                    'role' => 'user',
                    'content' => "
                JOB REQUIREMENTS (Skills needed): $skillString
                
                CV TEXT:
                $text

                TASK:
                1. Extract basic info. 
                2. SPECIAL RULE for 'phone': Return ONLY digits and a plus sign at the start, no spaces or dashes (e.g., +6289661100175).
                3. Calculate a match 'score' (0-100) based on the JOB REQUIREMENTS.
                
                Return JSON with keys: name, email, phone, skills (array), summary, score (integer)."
                ]
            ],
            'temperature' => 0.1
        ]);

        if (!$response->successful()) {
            dd($response->json());
        }

        $content = $response->json()['choices'][0]['message']['content'] ?? '';
        $content = preg_replace('/```json|```/', '', $content);

        return json_decode(trim($content), true) ?? [];
    }
}
