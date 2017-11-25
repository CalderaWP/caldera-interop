<?php


namespace calderawp\interop;


use calderawp\interop\Interfaces\Factory;

class ServiceContainer extends Container
{

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
        if( ! $this->pimple->offsetExists( $offset ) ){
            $this->pimple->offsetSet(
                $offset, new Industry(
                    $this->getServiceMap()
                )
            );
        }

        return $this->pimple[ $offset ];
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
        if( ! $this->pimple->offsetExists( $offset ) ){
            $this->pimple->offsetSet(
                $offset,
                new ServiceMap()
            );
        }

        return $this->pimple[ $offset ];


    }
}