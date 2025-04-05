<?php

declare(strict_types=1);

/**
 * @global  CMain $APPLICATION
 */

use Otus\Local\Infrastructure\TelegramSender;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

echo getenv('TELEGRAM_BOT_SECRET');

$tgSender = new TelegramSender(getenv('TELEGRAM_BOT_SECRET'));

dump($tgSender);

$tgSender->sendMessage((int)getenv('TELEGRAM_CHAT_ID'), 'Hello world');

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
