<?php

namespace zotov_mv\Logger\Contracts;

use Psr\Log\LoggerInterface;
use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;

interface Logger extends LoggerInterface
{

    /**
     * @return FormatterInterface
     */
    public function getFormatter();

    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter);

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

    /**
     *
     * @param string $channel
     */
    public function setChannel($channel);

    /**
     * @return string
     */
    public function getChannel();

}