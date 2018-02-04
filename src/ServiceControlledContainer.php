<?php


namespace calderawp\interop;


use calderawp\interop\Events\Events;
use calderawp\interop\Exceptions\NotImplemented;
use calderawp\interop\Interfaces\Factory;
use calderawp\interop\Interfaces\Service;
use NetRivet\WordPress\EventEmitter;

class ServiceControlledContainer extends ControlledContainer
{

    /** @inheritdoc */
    protected $attributes = [
        'industry',
        'serviceMap',
        'eventManager'
    ];

    /**
     * Register a service in the container
     *
     * @param Service $service
     * @throws NotImplemented
     */
    public function registerService( Service $service )
    {
        throw new NotImplemented();
    }

    /**
     * Reset underlying serviceMap object
     *
     * @param ServiceMap $serviceMap
     * @return $this
     */
    public function resetServiceMap( ServiceMap $serviceMap )
    {

        $this->set(
            'serviceMap',
            $serviceMap
        );

        return $this;

    }
    /**
     * Register a Service factory in the container
     *
     * @param Factory $factory
     *
     * @return $this
     */
    public function registerServiceFactory( Factory $factory, $namespace )
    {
        $this->getIndustry()->getServiceMap()->registerNamespace(
            $namespace,
            $factory->getMap()
        );

        return $this;
    }

    /**
     * Get main Industry object
     *
     * Acts as lazy-loader
     *
     * @return Industry
     */
    public function getIndustry()
    {
        $offset = 'industry';
        if( ! $this->has( $offset ) ){
            $this->set(
                $offset, new Industry(
                    $this
                )
            );
        }

        return $this->get( $offset );
    }


    /**
     * Get main ServiceMap object
     *
     * Acts as lazy-loader
     *
     * @return ServiceMap
     */
    public function getServiceMap()
    {
        $offset = 'serviceMap';
        if( ! $this->has( $offset ) ){
            $this->set(
                $offset,
                new ServiceMap()
            );
        }

        return $this->get( $offset );


    }

    /**
     * Get event manager
     *
     * @return Events
     */
    public function getEventsManager()
    {
        $offset = 'eventManager';
        if( ! $this->has( $offset ) )
        {
            $this->set(
                $offset,
                new Events( new EventEmitter() )
            );

        }

        return $this->get( $offset );

    }

}