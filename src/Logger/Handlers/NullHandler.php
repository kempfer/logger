<?php

namespace zotov_mv\Logger\Handlers;

use zotov_mv\Logger\Contracts\Record as RecordInterface;

class NullHandler extends AbstractHandler
{

    /**
     * @param RecordInterface $record
     *
     * @return bool
     */
    public function push(RecordInterface $record)
    {
        return true;
    }


}