<?php
/**
 * Created by PhpStorm.
 * User: zotov
 * Date: 17.04.2016
 * Time: 19:40
 */

namespace zotov_mv\Logger\Loggers;


use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;
use zotov_mv\Logger\Record;
use zotov_mv\Logger\RecordIterator;

class Null extends AbstractLogger
{
    protected function push(RecordInterface $record)
    {
        // TODO: Implement push() method.
    }

    protected function pushBatch(RecordIteratorInterface $records)
    {
        // TODO: Implement pushBatch() method.
    }


}