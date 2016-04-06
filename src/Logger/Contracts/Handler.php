<?php

namespace zotov_mv\Logger\Contracts;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;

interface Handler
{

    /**
     * @param RecordInterface $record
     *
     * @return bool
     */
    public function push(RecordInterface $record);

    /**
     * @param RecordInterface[] $records
     *
     */
    public function pushBatch(array $records);

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