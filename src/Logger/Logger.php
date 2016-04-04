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


    public function setTimezone(\DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
    }

    public function getTimezone()
    {
        if ($this->timezone === null) {
            $this->timezone = new \DateTimeZone('UTC');
        }

        return $this->timezone;
    }


    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }


}