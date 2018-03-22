<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Interfaces\ProvidesService;
use calderawp\interop\Service\Container;

class Provider implements ProvidesService
{

    /** @inheritdoc */
    public function registerService(Container $container)
    {
        $container->bind( 'MOCK', function (){
            return new \stdClass();
        } );

        $single = new \stdClass();
        $single->foo = 'bar';
        $container->singleton( 'S_MOCK', $single );
    }
}