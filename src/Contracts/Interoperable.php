<?php


namespace calderawp\interop\Contracts;

/**
 * Interface Interoperable
 *
 * Base entity that any Interoperable anything MUST implement.
 */
interface Interoperable extends Arrayable, \JsonSerializable
{
    /**
     * Create from an array
     *
     * @param array $data Data to initialize object with
     * @return $this
     */
    public static function fromArray( array $data );
}