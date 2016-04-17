<?php

namespace zotov_mv\Logger;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Helpers\InterpolateTrait;


class Record implements RecordInterface
{

    use InterpolateTrait;

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
     * @var bool
     */
    protected $isException;

    /**
     * @var \Throwable
     */
    protected $exception = null;

    /**
     * @var string|null
     */
    protected $preparedMessage = null;

    /**
     * Record constructor.
     *
     * @param string    $level
     * @param string    $message
     * @param \DateTime $time
     * @param array     $context
     */
    public function __construct($level, $message, \DateTime $time, array $context = [])
    {
        $this->level = $level;
        $this->message = $message;
        $this->time = $time;
        $this->setContext($context);
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
        if($this->preparedMessage === null) {
            $this->preparedMessage = $this->interpolate($this->message, $this->getContext());
        }
        return $this->preparedMessage;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return  \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time)
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
        $this->context = $this->prepareContext($context);
    }

    /**
     * @return \Throwable
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return boolean
     */
    public function useException()
    {
        return $this->isException;
    }

    /**
     * @param array $context
     *
     * @return array
     */
    protected function prepareContext(array $context)
    {
        if($this->contextCheckException($context)) {
            $this->isException = true;
            $this->exception = $context['except'];
            unset($context['except']);
        } else {
            $this->isException = false;
        }

        return $context;
    }

    /**
     * @param array $context
     *
     * @return bool
     */
    protected function contextCheckException(array $context)
    {
        if(
            array_key_exists('except', $context) &&
            ($context instanceof \Exception) &&
            ($context instanceof \Throwable))
        {
            return true;
        } else {
            return false;
        }
    }


}