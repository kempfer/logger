<?php

namespace zotov_mv\Logger;

use Psr\Log\AbstractLogger;
use zotov_mv\Logger\Contracts\Handler as HandlerInterface;
use zotov_mv\Logger\Contracts\Logger as LoggerInterface;

class Logger extends AbstractLogger implements LoggerInterface
{

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var
     */
    protected $timezone;

    /**
     * @var bool
     */
    protected $useMicrosecondTimestamps;

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
     * Control the use of microsecond resolution timestamps in the 'datetime'
     * member of new records.
     *
     * @param bool $micro True to use microtime() to create timestamps
     */
    public function useMicrosecondTimestamps($micro)
    {
        $this->useMicrosecondTimestamps = (bool) $micro;
    }


    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }


}