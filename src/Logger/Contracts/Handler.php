<?php

namespace zotov_mv\Logger\Contracts;


interface Handler
{

    /**
     * @param array $record
     *
     * @return mixed
     */
    public function push(array $record);

    /**
     * @param array $records
     *
     * @return mixed
     */
    public function pushBatch(array $records);
}