<?php


namespace calderawp\interop\Interfaces;


use calderawp\interop\Entities\Entity;

/**
 * Interface EntityFactory
 *
 * Interface that any service acting as an Entity factory MUST impliment
 *
 * @package calderawp\interop\Interfaces
 */
interface EntityFactory extends Factory
{
    /**
     * @param $type
     * @param array $args
     * @return Entity
     */
    public function createEntity( $type, array  $args = [] );

}