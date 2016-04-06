<?php

namespace zotov_mv\Logger\Handlers;

use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;
use zotov_mv\Logger\Contracts\Handler as HandlerInterface;
use zotov_mv\Logger\Formatter\Line;

abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var FormatterInterface
     */
    protected $formatter = Line::class;



    /**
     * {@inheritdoc}
     */
    public function getFormatter()
    {
        if(gettype ($this->formatter) == 'string'){
            $this->formatter = new $this->formatter;
        }

        return $this->formatter;
    }

    /**
     * {@inheritdoc}
     */
    public function setFormatter(FormatterInterface $formatter)
    {
       $this->formatter = $formatter;
    }


    /**
     * {@inheritdoc}
     */
    public function pushBatch(array $records)
    {
        foreach($records as $record) {
            $this->push($record);
        }
    }

}