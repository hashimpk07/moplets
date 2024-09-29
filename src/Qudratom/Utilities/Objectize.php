<?php
namespace Qudratom\Utilities;


use IteratorAggregate;
use Traversable;

class Objectize implements IteratorAggregate
{
    public $array ;

    public function __construct($array)
    {
        $this->array = $array ;
    }
    public function getIterator()
    {
        return $this->array ;
    }
}