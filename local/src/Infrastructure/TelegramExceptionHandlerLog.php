<?php

namespace Otus\Local\Infrastructure;

use Bitrix\Main\Context;
use Bitrix\Main\Diag\ExceptionHandlerFormatter;
use Bitrix\Main\Diag\FileExceptionHandlerLog;

class TelegramExceptionHandlerLog extends FileExceptionHandlerLog
{
    public function write($exception, $logType): void
    {
        parent::write($exception, $logType);

        $message = ExceptionHandlerFormatter::format($exception, true, 0);
        $context = Context::getCurrent();

        if ($context !== null) {
            $server = $context->getServer();

            if ($server->getUserAgent()) {
                $message .= 'User-agent: ' . $server->getUserAgent();
            }

            if ($server->getRequestUri()) {
                $message .= ' | Url: ' . $server->getRequestUri();
            }
        }

        (new TelegramSender(getenv('TELEGRAM_BOT_SECRET')))
            ->sendMessage(
                (int)getenv('TELEGRAM_CHAT_ID'),
                $message
            );
    }
}
