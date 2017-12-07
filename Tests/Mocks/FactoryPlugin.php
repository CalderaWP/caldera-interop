<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Events\Event;
use calderawp\interop\Events\Events;

class FactoryPlugin extends Plugin
{

    public function pluginLoaded(Events $events)
    {
        $event = Event::fromArray( [
            'name' => 'calderaInterop.Industry.createEntity.pre',
            'callback' => function( $entity, $_args ){
                $type = $_args[ 'type' ];
                $args = $_args[ 'args' ];
                switch ( $type ){
                    case 'Entities.Field' :
                        $entity = new \stdClass();
                        break;
                }

                return $entity;
            },
            'args' => 2,
            'priority' => 5
        ]);

        $events->addFilter( $event );

    }

}