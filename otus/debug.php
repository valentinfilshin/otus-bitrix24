<?php

declare(strict_types=1);

/**
 * @global  CMain $APPLICATION
 */

use Otus\Local\Infrastructure\TelegramSender;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$tgSender = new TelegramSender(getenv('TELEGRAM_BOT_SECRET'));
$tgSender->sendMessage((int)getenv('TELEGRAM_CHAT_ID'),  date('Y-m-d H:i:s'));

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
