<?php

namespace zotov_mv\Logger\Contracts;

use Psr\Log\LoggerInterface;
use zotov_mv\Logger\Contracts\Handler as HandlerInterface;

interface Logger extends LoggerInterface
{

    /**
     * @return HandlerInterface
     */
    public function getHandler();

    /**
     * @param HandlerInterface $handler
     */
    public function setHandler(HandlerInterface $handler);

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