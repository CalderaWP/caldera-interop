<?php


namespace calderawp\interop\Mock;

use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use calderawp\interop\Interfaces\ProvidesService;


class Provider implements ProvidesService
{

    /** @inheritdoc */
    public function registerService(ServiceContainer $container)
    {
        $container->bind( 'MOCK', function (){
            return new \stdClass();
        } );

        $single = new \stdClass();
        $single->foo = 'bar';
        $container->singleton( 'S_MOCK', $single );
    }

	/** @inheritdoc */
	public function getAlias()
	{
		return 'MOCK';
	}

}