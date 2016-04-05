<?php

namespace zotov_mv\Logger\Contracts;

use zotov_mv\Logger\Contracts\Record as RecordInterface;

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
}