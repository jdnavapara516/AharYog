<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    $productDetails = $data['productDetails'] ?? null;
    $healthCondition = $data['healthCondition'] ?? null;

    if (!$productDetails || !$healthCondition) {
        echo json_encode(['status' => 'error', 'message' => 'Product details and health condition are required']);
        exit;
    }

    $openAiApiKey = 'YOUR_OPENAI_API_KEY';
    $openAiUrl = 'https://api.openai.com/v1/engines/davinci-codex/completions';

    $prompt = "Analyze the following food product details: " . json_encode($productDetails) . 
              " considering the user's health condition: " . $healthCondition . 
              ". Provide a rating out of 5 and a brief explanation.";

    $response = file_get_contents($openAiUrl, false, stream_context_create([
        'http' => [
            'header' => [
                "Content-Type: application/json",
                "Authorization: Bearer $openAiApiKey"
            ],
            'method' => 'POST',
            'content' => json_encode([
                'prompt' => $prompt,
                'max_tokens' => 100,
                'n' => 1,
                'stop' => null,
                'temperature' => 0.7,
            ]),
        ],
    ]));

    $result = json_decode($response, true);

    if (isset($result['choices'][0]['text'])) {
        echo json_encode(['status' => 'success', 'analysis' => trim($result['choices'][0]['text'])]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to analyze food quality']);
    }
    exit;
}
?>