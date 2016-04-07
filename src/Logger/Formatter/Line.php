<?php

namespace zotov_mv\Logger\Formatter;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;

class Line extends Basic

{
    protected $simpleFormat = "[{datetime}] {level_name}: {message} {context} {extra}\n";

    /**
     * {@inheritdoc}
     */
    public function format(RecordInterface $record)
    {
        return $this->interpolate($this->simpleFormat, [
            'datetime' => $record->getTime()->format('d.m.Y H:i:s'),
            'level_name' => $record->getLevel(),
            'message' => $record->getMessage(),
            'context' => json_encode($record->getContext()),
            'extra' => ''
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function formatBatch(RecordIteratorInterface $records)
    {
        $format = '';
        foreach ($records as $record) {
            $format .= $this->format($record);
        }

        return $format;
    }


}