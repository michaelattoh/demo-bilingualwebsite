<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $text = $requestData['text'];
    $target = $requestData['target'];

    $apiKey = 'AIzaSyDKy7Hsw9U1CkoOWfCOcrRnOnWDdbXvIcc';
    $url = 'https://translation.googleapis.com/language/translate/v2?key=' . $apiKey;

    $data = [
        'q' => $text,
        'target' => $target
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        echo json_encode(['error' => 'Translation failed']);
        exit;
    }

    $responseData = json_decode($result, true);
    $translatedText = $responseData['data']['translations'][0]['translatedText'] ?? '';

    echo json_encode(['translatedText' => $translatedText]);
}
?>