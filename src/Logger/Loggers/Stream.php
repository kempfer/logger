<?php

namespace zotov_mv\Logger\Loggers;

use zotov_mv\Logger\Contracts\Record as RecordInterface;
use zotov_mv\Logger\Contracts\RecordIterator as RecordIteratorInterface;

class Stream extends AbstractLogger
{
    /**
     * @var resource
     */
    private $stream;

    /**
     * @var string
     */
    private $url;

    /**
     * @var int|null
     */
    private $filePermission;

    /**
     * @var bool
     */
    private $useLocking;

    /**
     * StreamHandler constructor.
     *
     * @param resource|string $stream
     * @param int|null        $filePermission
     * @param bool            $useLocking
     *
     * @throws \InvalidArgumentException If stream is not a resource or string
     */
    public function __construct($stream, $filePermission = null, $useLocking = false)
    {
        $this->setStream($stream);

        $this->filePermission = $filePermission;

        $this->useLocking = $useLocking;
    }

    /**
     * {@inheritdoc}
     */
    protected function push(RecordInterface $record)
    {
        $formattedRecord = $this->getFormatter()->format($record, $this->getChannel());
        $this->write($formattedRecord);
    }

    /**
     * {@inheritdoc}
     */
    protected function pushBatch(RecordIteratorInterface $records)
    {
        $formattedRecord = $this->getFormatter()->formatBatch($records, $this->getChannel());
        $this->write($formattedRecord);
    }


    protected function write($formattedRecord)
    {
        $this->prepareSteam();

        $this->fileLocking(LOCK_EX);

        fwrite($this->stream, (string)$formattedRecord);

        $this->fileLocking(LOCK_UN);
    }

    public function close()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }

        $this->stream = null;
    }


    /**
     * @param string $stream
     *
     * @throws \InvalidArgumentException If stream is not a resource or string
     */
    protected function setStream($stream)
    {
        if (is_resource($stream)) {
            $this->stream = $stream;
        } elseif (is_string($stream)) {
            $this->url = $stream;
        } else {
            throw new \InvalidArgumentException("If stream is not a resource or string");
        }
    }

    protected function prepareSteam()
    {
        if (!is_resource($this->stream)) {
            $this->stream = fopen($this->url, 'a');
            $this->setFilePermission();
        }
    }

    protected function setFilePermission()
    {
        if ($this->filePermission !== null) {
            @chmod($this->url, $this->filePermission);
        }
    }

    /**
     * @param int $status
     */
    protected function fileLocking($status)
    {
        if ($this->useLocking) {
            flock($this->stream, $status);
        }
    }
}