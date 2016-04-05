<?php

namespace zotov_mv\Logger;

use zotov_mv\Logger\Contracts\Record as RecordInterface;


class Record implements RecordInterface
{

    /**
     * @var string
     */
    protected $level;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $context;

    /**
     * @var string
     */
    protected $time;

    /**
     * Record constructor.
     *
     * @param string $level
     * @param string $message
     * @param string $time
     * @param array  $context
     */
    public function __construct($level, $message, $time,  array $context = [])
    {
        $this->level = $level;
        $this->message = $message;
        $this->time = $time;
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }



    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param array $context
     */
    public function setContext(array $context)
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function toString()
    {
        // TODO: Implement toString() method.
    }


}