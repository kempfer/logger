<?php

namespace zotov_mv\Logger\Contracts;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;

interface Handler
{

    /**
     * @param RecordInterface $record
     *
     * @return bool
     */
    public function push(RecordInterface $record);

    /**
     * @param RecordIteratorInterface $records
     */
    public function pushBatch(RecordIteratorInterface $records);

    /**
     * @return Formatter
     */
    public function getFormatter();

    /**
     * @param Formatter $formatter
     *
     * @return mixed
     */
    public function setFormatter(FormatterInterface $formatter);
}