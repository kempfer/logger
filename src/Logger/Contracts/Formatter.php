<?php


namespace zotov_mv\Logger\Contracts;


use zotov_mv\Logger\Contracts\Record as RecordInterface;

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

    public function formatBatch(array $record);
}