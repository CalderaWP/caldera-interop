<?php


namespace calderawp\interop\Traits;

/**
 * Trait CanBecomeFromArray
 *
 * A static method for creating from an array expecting the array to have keys that match object's properties
 */
trait CanBecomeFromArray
{
    /**
     * Create from array
     *
     * @param  array $items
     * @return static
     */
    public static function fromArray(array $items)
    {
        $obj = new static($items);
        foreach ($items as $key => $item) {
            $obj->__set($key, $item);
        }
        return $obj;
    }

}