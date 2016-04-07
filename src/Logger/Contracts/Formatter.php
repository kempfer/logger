<?php


namespace zotov_mv\Logger\Contracts;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;

interface Formatter
{
    /**
     * Formats a log record.
     *
     * @param  RecordInterface $record A record to format
     *
     * @return mixed The formatted record
     */
    public function format(RecordInterface $record);

    /**
     * @param RecordIteratorInterface $records
     *
     * @return mixed
     */
    public function formatBatch(RecordIteratorInterface $records);
}