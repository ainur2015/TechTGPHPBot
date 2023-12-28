<?php

namespace TechTGPHP\tg_api;

class TechTGPHP {
    private $token;
    private $apiUrl = 'https://api.telegram.org/bot';
    private $logFile = 'tgphp_errors.log';

    public function __construct($token) {
        $this->token = $token;
    }

    private function logError($message) {
        file_put_contents($this->logFile, "[" . date("Y-m-d H:i:s") . "] " . $message . "\n", FILE_APPEND);
    }

    private function callAPI($method, $params = []) {
        $url = $this->apiUrl . $this->token . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->logError("cURL Error: " . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($response, true);
    }

    public function sendMessage($chatId, $text) {
        $params = [
            'chat_id' => $chatId,
            'text' => $text
        ];
        return $this->callAPI('sendMessage', $params);
    }

   public function sendPhoto($chatId, $photoPath, $caption = '') {
    $filePath = realpath($photoPath);
    
    if (!$filePath) {
        // Если файл не найден
        return false;
    }

    $params = [
        'chat_id' => $chatId,
        'photo' => new \CURLFile($filePath),
        'caption' => $caption
    ];

    return $this->callAPI('sendPhoto', $params);
}


  public function sendDocument($chatId, $documentPath, $caption = '') {
    $filePath = realpath($documentPath);
    
    if (!$filePath) {
        // Если файл не найден
        return false;
    }

    $params = [
        'chat_id' => $chatId,
        'document' => new \CURLFile($filePath),
        'caption' => $caption
    ];

    // Инициализация cURL сессии
    $ch = curl_init();

    // Установка опций cURL
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot{$this->token}/sendDocument");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    // Выполнение запроса и получение ответа
    $response = curl_exec($ch);

    // Проверка на наличие ошибок
    if (curl_errno($ch)) {
        $this->logError("cURL Error: " . curl_error($ch));
        return false;
    }

    // Закрытие cURL сессии
    curl_close($ch);

    return json_decode($response, true);
}



public function sendMessageWithButton($chatId, $text, $buttonText) {
    $keyboard = [
        'keyboard' => [
            [
                ['text' => $buttonText]
            ]
        ],
        'resize_keyboard' => true,
        'one_time_keyboard' => true
    ];
    $params = [
        'chat_id' => $chatId,
        'text' => $text,
        'reply_markup' => json_encode($keyboard)
    ];
    return $this->callAPI('sendMessage', $params);
}


}
