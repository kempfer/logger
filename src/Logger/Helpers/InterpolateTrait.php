<?php
/**
 * Created by PhpStorm.
 * User: zotov
 * Date: 07.04.2016
 * Time: 23:55
 */

namespace zotov_mv\Logger\Helpers;


trait InterpolateTrait
{
    /**
     * @param string $message
     * @param array  $words
     *
     * @return string
     */
    protected function interpolate($message, array $words = [])
    {
        // Построение массива подстановки с фигурными скобками
        // вокруг значений ключей массива context.
        $replace = array();
        foreach ($words as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }

        // Подстановка значений в сообщение и возврат результата.
        return strtr($message, $replace);
    }
}