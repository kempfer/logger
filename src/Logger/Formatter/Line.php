<?php

namespace zotov_mv\Logger\Formatter;

use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;
use zotov_mv\Logger\Contracts\Record as RecordInterface;

class Line implements FormatterInterface
{

    protected $simpleFormat = "[%datetime%] %level_name%: %message% %context% %extra%\n";

    public function format(RecordInterface $record)
    {

        return '[' . $record->getTime()->format('d.m.Y H:m') . '] ' .
            $record->getLevel() . ': ' .
            $record->getMessage() . "\n";
    }

    public function formatBatch(array $record)
    {
        // TODO: Implement formatBatch() method.
    }


}