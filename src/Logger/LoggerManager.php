<?php

namespace zotov_mv\Logger;

use zotov_mv\Logger\Contracts\LoggerManager as LoggerManagerInterface;
use zotov_mv\Logger\Contracts\Logger as LoggerInterface;

class LoggerManager implements LoggerManagerInterface
{

    /**
     * @var string
     */
    protected $channel = 'local';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var \DateTimeZone
     */
    protected $timeZone;

    /**
     * LoggerManager constructor.
     *
     * @param LoggerInterface $logger
     * @param string          $channel
     * @param \DateTimeZone   $timeZone
     */
    public function __construct(LoggerInterface $logger, $channel = 'local', \DateTimeZone $timeZone = null)
    {
        $this->channel = $channel;
        if($timeZone === null) {
            $this->timeZone = new \DateTimeZone('UTC');
        } else {
            $this->timeZone = $timeZone;
        }
        $this->setLogger($logger);
    }

    /**
     * @param \DateTimeZone $timezone
     */
    public function setTimezone(\DateTimeZone $timezone)
    {
        $this->timeZone = $timezone;
    }

    /**
     * @return \DateTimeZone
     */
    public function getTimezone()
    {
        return $this->timeZone;
    }


    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }



    /**
     * Get a logger instance on the object.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->logger->setTimezone($this->getTimezone());
        $this->logger->setChannel($this->getChannel());
    }


}