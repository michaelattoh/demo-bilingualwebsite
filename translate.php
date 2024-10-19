<?php

if (isset($_GET['lang']) && isset($_GET('text'))) {
   $lang = $_GET['lang'];
   $text = $_GET['text'];

   $apiKey = "26a0373407474f1cb3fa01f09a7f85e2";
   $url = "https://api.cognitive.microsofttranslator.com/"

   $data = [
    'q' => $text,
    'target' => $lang
   ];

   $options = [
    'http' => [
        'header' => "Content-Type: application/json\r\n".
                    "Authorizarion: Bearer $apiKey\r\n",
        'method' => 'POST',
        'content' => json_encode($data),
    ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        echo json_encode(['error' => 'Translation failed.']);
        exit;
    }
    echo $response;
} else {
    echo json_encode(['error' => 'Invalid parameters.']);
}
?>