<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface Service
 *
 * Interface that any class acting as a service MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface Service
{

    /**
     * Defines a service type
     *
     * @return string
     */
    public function getType();

}
