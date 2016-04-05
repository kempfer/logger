<?php

namespace zotov_mv\Logger\Handlers;


use zotov_mv\Logger\Contracts\Record as RecordInterface;

class StreamHandler extends AbstractHandler
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
    public function push(RecordInterface $record)
    {
        // TODO: Implement push() method.
    }

    /**
     * {@inheritdoc}
     */
    public function pushBatch(array $records)
    {
    }


    /**
     * @param string $stream
     *
     * @throws \InvalidArgumentException If stream is not a resource or string
     */
    protected function setStream($stream)
    {
        if(is_resource($stream)) {
            $this->stream = $stream;
        } elseif(is_string($stream)) {
            $this->url = $stream;
        } else {
            throw new \InvalidArgumentException("If stream is not a resource or string");
        }
    }

    public function close()
    {
        if(is_resource($this->stream)){
            fclose($this->stream);
        }
    }

    public function __destruct()
    {
        $this->close();
    }


}