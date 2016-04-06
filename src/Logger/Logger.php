<?php

namespace zotov_mv\Logger;

use Psr\Log\AbstractLogger;
use zotov_mv\Logger\Contracts\Handler as HandlerInterface;
use zotov_mv\Logger\Contracts\Logger as LoggerInterface;
use Psr\Log\InvalidArgumentException;

class Logger extends AbstractLogger implements LoggerInterface
{

    /**
     * @var Record[]
     */
    protected $buffer = [];

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var bool
     */
    protected $deferredRecord;

    /**
     * @var \DateTimeZone
     */
    protected $timezone;


    /**
     * Logger constructor.
     *
     * @param HandlerInterface $handler
     * @param bool             $deferredRecord
     */
    public function __construct(HandlerInterface $handler, $deferredRecord = false)
    {
        $this->setHandler($handler);
        $this->deferredRecord = $deferredRecord;
    }


    /**
     * @return HandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param HandlerInterface $handler
     */
    public function setHandler(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Set the timezone to be used for the timestamp of log records.
     *
     * @param \DateTimeZone $timezone Timezone object
     */
    public function setTimezone(\DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * Get the timezone to be used for the timestamp of log records.
     *
     * @return \DateTimeZone
     */
    public function getTimezone()
    {
        if ($this->timezone === null) {
            $this->timezone = new \DateTimeZone('UTC');
        }

        return $this->timezone;
    }

    /**
     * @return boolean
     */
    public function isDeferredRecord()
    {
        return $this->deferredRecord;
    }

    /**
     * @param boolean $deferredRecord
     */
    public function setDeferredRecord($deferredRecord)
    {
        $this->deferredRecord = (bool)$deferredRecord;
    }


    /**
     * Logs with an arbitrary level.
     *
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function log($level, $message, array $context = [])
    {
        $this->checkLevel($level);
        $record = new  Record($level, (string)$message, $this->getDateTime(), $context);
        if ($this->isDeferredRecord()) {
            $this->buffer[] = $record;
        } else {
            $this->handlerPush($record);
        }

    }

    /**
     * @param string $level
     */
    protected function checkLevel($level)
    {
        if (!defined('Psr\Log\LogLevel::' . mb_strtoupper($level))) {
            throw new InvalidArgumentException("Unknown type level: " . $level);
        }

    }

    /**
     * @param Record $record
     */
    protected function handlerPush(Record $record)
    {
        $this->handler->push($record);
    }

    /**
     * @return \DateTime
     */
    protected function getDateTime()
    {
        return new \DateTime('now', $this->timezone);
    }

    public function __destruct()
    {
        $this->handler->pushBatch($this->buffer);
    }


}