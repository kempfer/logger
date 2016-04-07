<?php

namespace zotov_mv\Logger\Contracts;

use \IteratorAggregate;
use zotov_mv\Logger\Contracts\Record as RecordInterface;


interface RecordIterator extends IteratorAggregate
{

    /**
     * @param Record $record
     *
     * @return mixed
     */
    public function addRecord(RecordInterface $record);
}