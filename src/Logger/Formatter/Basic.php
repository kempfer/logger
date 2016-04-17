<?php
/**
 * Created by PhpStorm.
 * User: zotov
 * Date: 08.04.2016
 * Time: 0:05
 */

namespace zotov_mv\Logger\Formatter;

use zotov_mv\Logger\Contracts\Formatter as FormatterInterface;
use zotov_mv\Logger\Helpers\InterpolateTrait;
use zotov_mv\Logger\Helpers\NormalizeTrait;

abstract class Basic implements FormatterInterface
{
    use InterpolateTrait, NormalizeTrait;

    protected $dateFormat = 'd.m.Y H:i:s';


    /**
     * @param array $data
     *
     * @return array
     */
    protected function normalizeContext(array $data)
    {
        return $this->normalizeData($data);
    }


}