<?php

require __DIR__.'/vendor/autoload.php';

use zotov_mv\Logger\LoggerManager;
use zotov_mv\Logger\Loggers\Stream as StreamLogger;
use zotov_mv\Logger\Formatter\Line as LineFormatter;

$stream = new StreamLogger('E:\project\check_list\my\logger\src\log.log');

$loggerAware = new LoggerManager($stream, 'dev', new DateTimeZone('Europe/Zaporozhye'));


$stream->setDeferredRecord(true);
$loggerAware->setLogger($stream);
try {
    throw new \Exception("Test");
} catch(\Exception $e){
    $loggerAware->getLogger()->alert('test message {name}', ['name' => 'maxim', 'except' => $e]);
}


