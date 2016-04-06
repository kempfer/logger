<?php

require __DIR__.'/vendor/autoload.php';

use zotov_mv\Logger\Logger;
use zotov_mv\Logger\Handlers\NullHandler;
use zotov_mv\Logger\Handlers\StreamHandler;
use zotov_mv\Logger\Formatter\Line as LineFormatter;

$streamHandler =  new StreamHandler('E:\project\check_list\my\logger\src\log.log');
$streamHandler->setFormatter(new LineFormatter());


$logger = new Logger($streamHandler);


