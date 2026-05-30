<?php

return [
    'ai' => [
        'enabled' => env('ENABLE_AI_FEATURES', true),
    ],
    'openai' => [
        'key' => env('OPENAI_API_KEY'),
    ],
    'groq' => [
        'key' => env('GROQ_API_KEY'),
    ],
];
