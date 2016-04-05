<?php

namespace zotov_mv\Logger\Contracts;


interface Record
{
    /**
     * @return string
     */
    public function getLevel();

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return array
     */
    public function getContext();

    /**
     * @param string $level
     */
    public function setLevel($level);

    /**
     * @param string $message
     *
     */
    public function setMessage($message);

    /**
     * @param array $context
     *
     */
    public function setContext(array $context);

    /**
     * @return string
     */
    public function getTime();

    /**
     * @param string $time
     */
    public function setTime($time);

    /**
     * @return string
     */
    public function toString();

}