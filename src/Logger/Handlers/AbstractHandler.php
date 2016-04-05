<?php

namespace zotov_mv\Logger\Handlers;

use zotov_mv\Logger\Contracts\Handler as HandlerInterface;

abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @param array $records
     */
    public function pushBatch(array $records)
    {
        foreach($records as $record) {
            $this->push($record);
        }
    }

}