<?php


namespace calderawp\interop;

use calderawp\interop\Collections\Collection;
use calderawp\interop\Entities\Entity;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Exceptions\InvalidServiceArgsException;
use calderawp\interop\Exceptions\MissingServiceException;
use calderawp\interop\Interfaces\CollectionFactory;
use calderawp\interop\Interfaces\EntityFactory;


/**
 * Class Industry
 *
 * Acts as an automagic factory for entities and collections.
 *
 * @package calderawp\interop
 */
class Industry
{

    /**
     * @var ServiceMap
     */
    protected $serviceMap;

    /**
     * Industry constructor.
     *
     * @param ServiceMap $serviceMap
     */
    public function __construct( ServiceMap $serviceMap )
    {
        $this->serviceMap = $serviceMap;
    }

    /**
     * Get ServiceMap object
     *
     * @return ServiceMap
     */
    public function getServiceMap()
    {
        return $this->serviceMap;
    }


    /**
     * Create a new entity that has a service mapping
     *
     * @param $type
     * @param array $args
     * @return Entity
     * @throws InvalidServiceArgsException
     * @throws MissingServiceException
     */
    public function createEntity( $type, array $args = [] )
    {

        try{
            $class = $this->getServiceMap()->getEntity( $type  );
            return $this->instantiateClass( $class, $args);
        }catch ( ContainerException $e ){
            throw new MissingServiceException( $type );
        }
    }

    /**
     * Create a new collection that has a service mapping
     *
     * @param $type
     * @param array $args
     * @return Collection
     * @throws InvalidServiceArgsException
     * @throws MissingServiceException
     */
    public function createCollection( $type, array $args = [] )
    {
        try{
            $class = $this->serviceMap->getCollection( $type );
            return $this->instantiateClass( $class, $args);
        }catch ( ContainerException $e ){
            throw new MissingServiceException( $type );
        }

    }

    /**
     * Insantiate a class via reflection class
     *
     * @param $class
     * @param array $args
     * @return object
     */
    protected function instantiateClass( $class, array  $args = [] )
    {
        $reflectionClass = new \ReflectionClass( $class );
        if ( ! empty( $args )) {
            return $reflectionClass->newInstanceArgs($args);
        } else {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

    }

}