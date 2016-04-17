<?php

namespace zotov_mv\Logger\Formatter;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;

class Line extends Basic
{
    protected $simpleFormat = "[{datetime}] {channel}.{level_name}: {message} {context} {except}\n";

    /**
     * {@inheritdoc}
     */
    public function format(RecordInterface $record, $channel)
    {
        $data = [
            'channel' => $channel,
            'datetime' => $record->getTime()->format($this->dateFormat),
            'level_name' => $record->getLevel(),
            'message' => $record->getMessage(),
            'context' => $this->toJson($this->normalizeContext($record->getContext())),
            'except' => ''
        ];
        if ($record->useException()) {
            $data['except'] =  $this->toJson($this->normalizeException($record->getException()));
        }

        return $this->interpolate($this->simpleFormat, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function formatBatch(RecordIteratorInterface $records, $channel)
    {
        $format = '';
        foreach ($records->getIterator() as $record) {
            $format .= $this->format($record, $channel);
        }

        return $format;
    }


}