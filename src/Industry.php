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
     * @var ServiceContainer
     */
    protected $serviceContainer;

    /**
     * Industry constructor.
     *
     * @param ServiceContainer $serviceContainer
     */
    public function __construct( ServiceContainer $serviceContainer )
    {
        $this->serviceContainer = $serviceContainer;
        $this->serviceMap = $this->serviceContainer->getServiceMap();
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
     * @return ServiceContainer
     */
    public function getServiceContainer()
    {
        return $this->serviceContainer;
    }

    /**
     * Create a new entity that has a service mapping
     *
     * NOTE: Entities are created using reflection class, and may be cached.
     *
     * @param string $type Entity type -- as ::class reference
     * @param array $args Optional. Array of args to pass to constructor.
     *
     * @return Entity
     * @throws InvalidServiceArgsException
     * @throws MissingServiceException
     */
    public function createEntity( $type, array $args = [] )
    {

        $_args =  [
            'type' => $type,
            'args' => $args
        ];

        $entity = $this->serviceContainer
            ->getEventsManager()
            ->applyFilters(
                'calderaInterop.Industry.createEntity.pre',
                null,
                $_args
            );


        if( $entity ){
            return $entity;
        }

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
        if ( ! empty( $args ) && $reflectionClass->hasMethod( '__construct' )) {
            return $reflectionClass->newInstanceArgs($args);
        } else {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

    }

}