<?php


namespace calderawp\interop;



class ServiceFactory
{
    /**
     * @var ServiceContainer
     */
    protected $serviceContainer;
    public function __construct(ServiceContainer $serviceContainer ){

        $this->serviceContainer = $serviceContainer;
    }


    /**
     * @param $type
     * @param null $data
     *
     * @reurn
     */
    public function entity( $type, $data = null )
    {
        if( $this->serviceContainer->doesProvide($type ) ){
            switch ( $type ){
                case 'array':

            }
        }
    }
}