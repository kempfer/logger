<?php
/**
 * Created by PhpStorm.
 * User: zotov
 * Date: 17.04.2016
 * Time: 21:53
 */

namespace zotov_mv\Logger\Helpers;


trait NormalizeTrait
{
    /**
     * @param mixed $data
     *
     * @return array|string
     */
    protected function normalizeData($data)
    {
        switch (true) {
            case (null === $data || is_scalar($data)) :
                return $this->normalizeScalar($data);
                break;
            case (is_array($data) || $data instanceof \Traversable):
                return $this->normalizeArray($data);
                break;
            case $data instanceof \DateTime :
                return $this->normalizeDateTime($data);
                break;
            case is_object($data) :
                return $this->normalizeObject($data);
                break;
            case is_resource($data) :
                return $this->normalizeResource($data);
                break;
            default :
                return '[unknown(' . gettype($data) . ')]';
                break;
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function normalizeArray(array $data)
    {
        $normalized = [];

        $count = 1;
        foreach ($data as $key => $value) {
            if ($count >= 1000) {
                $normalized['...'] = 'Over 1000 items, aborting normalization';
                break;
            }
            $normalized[$key] = $this->normalizeData($value);
            $count++;
        }

        return $normalized;
    }

    /**
     * @param $data
     *
     * @return string
     */
    protected function normalizeObject($data)
    {
        if ($data instanceof \Throwable || $data instanceof \Exception) {
            return $this->normalizeException($data);
        }
        // non-serializable objects that implement __toString stringified
        if (method_exists($data, '__toString') && !$data instanceof \JsonSerializable) {
            $value = $data->__toString();
        } else {
            // the rest is json-serialized in some way
            $value = $this->toJson($data);
        }

        return sprintf("[object] (%s: %s)", get_class($data), $value);
    }

    /**
     * @param resource $data
     *
     * @return string
     */
    protected function normalizeResource($data)
    {
        return sprintf('[resource] (%s)', get_resource_type($data));
    }

    /**
     * @param \DateTime $data
     *
     * @return string
     */
    protected function normalizeDateTime(\DateTime $data)
    {
        return $data->format($this->dateFormat);
    }

    /**
     * @param mixed $data
     *
     * @return string
     */
    protected function normalizeScalar($data)
    {
        if (is_float($data)) {
            if (is_infinite($data)) {
                return ($data > 0 ? '' : '-') . 'INF';
            }
            if (is_nan($data)) {
                return 'NaN';
            }
        }

        return $data;
    }

    /**
     * @param \Throwable $e
     *
     * @return array
     */
    protected function normalizeException($e)
    {
        $data = array(
            'class' => get_class($e),
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile() . ':' . $e->getLine(),
        );

        $trace = $e->getTrace();
        foreach ($trace as $frame) {
            if (array_key_exists('file', $frame)) {
                $data['trace'][] = $frame['file'] . ':' . $frame['line'];
            } else {
                // We should again normalize the frames, because it might contain invalid items
                $data['trace'][] = $this->toJson($this->normalizeData($frame));
            }
        }
        $previous = $e->getPrevious();
        if ($previous) {
            $data['previous'] = $this->normalizeException($previous);
        }

        return $data;
    }

    /**
     * Return the JSON representation of a value
     *
     * @param  mixed $data
     *
     * @return string
     */
    protected function toJson($data)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        return json_encode($data);
    }
}