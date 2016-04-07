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

abstract class Basic implements  FormatterInterface
{
    use InterpolateTrait;


    protected function normalizeContext(array $data)
    {

    }
}