<?php
/**
 * Created by PhpStorm.
 * User: zotov
 * Date: 07.04.2016
 * Time: 22:43
 */

namespace zotov_mv\Logger;

use \ArrayIterator;
use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;


class RecordIterator implements RecordIteratorInterface
{

    /**
     * @var array
     */
    protected $records = [];

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->records);
    }

    /**
     * {@inheritdoc}
     */
    public function addRecord(RecordInterface $record)
    {
        $this->records[] = $record;
    }


}