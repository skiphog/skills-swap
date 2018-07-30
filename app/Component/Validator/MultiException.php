<?php

namespace App\Component\Validator;

use Traversable;

class MultiException extends \Exception implements \JsonSerializable, \IteratorAggregate, \Countable
{
    protected $data;

    /**
     * @param string     $key
     * @param \Throwable $e
     *
     * @return $this
     */
    public function add($key, \Throwable $e)
    {
        $this->data[$key] = $e;

        return $this;
    }

    /**
     * @return \Exception[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !$this->isEmpty();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($value) {
            /** @var self $value */
            return $value->getMessage();
        }, $this->data);
    }


    /**
     * @todo проверить другие варианты
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }


    /**
     * @return \ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @return int
     */
    public function count()
    {
        return \count($this->data);
    }
}
