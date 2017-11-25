<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface Factory
 *
 * Interface that any service acting as an factory MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface Factory extends Service
{


    /**
     * Get map of ovverides for this Factory
     *
     * @return array
     */
    public function getMap();
}