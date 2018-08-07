<?php

namespace App\Traits;

trait IteratorAggregate
{
    protected $data = [];
    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }
}
