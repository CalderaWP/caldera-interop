<?php


namespace calderawp\interop\ArrayLike;
use calderawp\interop\Interfaces\Arrayable;

;


/**
 * Class ArrayLike
 *
 * Basic array-like object.
 *
 * @package calderawp\interop\ArrayLike
 */
abstract class ArrayLike implements \ArrayAccess, Arrayable {

    /**
     * @var array
     */
    private $items = [];

    public function __construct( array $items = [] )
    {
        $this->items = $items;
    }

    /** @inheritdoc */
    public function toArray()
    {
        return $this->items;
    }

    /** @inheritdoc */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /** @inheritdoc */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /** @inheritdoc */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /** @inheritdoc */
    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }
}