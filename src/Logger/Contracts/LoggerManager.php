<?php

namespace zotov_mv\Logger\Contracts;

use zotov_mv\Logger\Contracts\Logger as LoggerInterface;

interface LoggerManager
{

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * @return LoggerInterface
     */
    public function getLogger();

    /**
     *
     * @param string $channel
     */
    public function setChannel($channel);

    /**
     * @return string
     */
    public function getChannel();

    /**
     * Set the timezone to be used for the timestamp of log records.
     *
     * @param \DateTimeZone $timezone Timezone object
     */
    public function setTimezone(\DateTimeZone $timezone);

    /**
     * Get the timezone to be used for the timestamp of log records.
     *
     * @return \DateTimeZone
     */
    public function getTimezone();
}