<?php

declare(strict_types=1);

namespace Otus\Local\Infrastructure;

class TelegramSender
{
    private const BASE_PATH = 'https://api.telegram.org/';

    private string $apiUrl;

    public function __construct(string $secretKey)
    {
        $this->apiUrl = self::BASE_PATH . 'bot' . $secretKey;
    }

    public function sendMessage(int $chatId, string $message): void
    {
        $url = $this->apiUrl . '/sendMessage';

        $data = array(
            'chat_id' => $chatId,
            'text' => htmlspecialchars($message),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
            'disable_notification' => false
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data
        ));
        curl_exec($ch);
        curl_close($ch);
    }
}
