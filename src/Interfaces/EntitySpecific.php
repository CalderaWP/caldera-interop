<?php


namespace calderawp\interop\Interfaces;


interface EntitySpecific
{

    /**
     * Get class reference for entity being collected
     *
     * @return string
     */
    public function getEntityType();
}