<?php

namespace zotov_mv\Logger\Loggers;

use zotov_mv\Logger\RecordIterator;
use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;
use zotov_mv\Logger\Record;
use zotov_mv\Logger\Contracts\Logger as LoggerInterface;
use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;
use zotov_mv\Logger\Formatter\Line as LineFormatter;
use Psr\Log\InvalidArgumentException;

abstract class AbstractLogger extends \Psr\Log\AbstractLogger implements LoggerInterface
{

    /**
     * @var RecordIterator
     */
    protected $buffer = null;

    /**
     * @var string
     */
    protected $channel;


    /**
     * @var bool
     */
    protected $deferredRecord;

    /**
     * @var \DateTimeZone
     */
    protected $timezone;

    /**
     * @var FormatterInterface
     */
    protected $formatter = LineFormatter::class;

    /**
     * {@inheritdoc}
     */
    public function getFormatter()
    {
        if (gettype($this->formatter) == 'string') {
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
     * @param string $level
     */
    protected function checkLevel($level)
    {
        if (!defined('Psr\Log\LogLevel::' . mb_strtoupper($level))) {
            throw new InvalidArgumentException("Unknown type level: " . $level);
        }

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
            $this->getBuffer()->addRecord($record);
        } else {
            $this->push($record);
        }
    }

    /**
     * @param RecordInterface $record
     */
    abstract protected function push(RecordInterface $record);

    /**
     * @param RecordIteratorInterface $records
     */
    abstract protected function pushBatch(RecordIteratorInterface $records);


    /**
     * @return \DateTime
     */
    protected function getDateTime()
    {
        return new \DateTime('now', $this->timezone);
    }

    /**
     * @return RecordIterator
     */
    protected function getBuffer()
    {
        if ($this->buffer === null) {
            $this->buffer = new RecordIterator();
        }

        return $this->buffer;
    }

    public function __destruct()
    {
        $this->pushBatch($this->getBuffer());
    }
}