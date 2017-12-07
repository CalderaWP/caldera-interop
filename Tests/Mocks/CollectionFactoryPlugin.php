<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Events\Event;
use calderawp\interop\Events\Events;

class CollectionFactoryPlugin extends Plugin
{

    /** @inheritdoc */
    public function pluginLoaded( Events $events)
    {
        $event = Event::fromArray( [
            'name' => 'calderaInterop.Industry.createCollection.pre',
            'callback' => function( $entity, $_args ){
                $type = $_args[ 'type' ];
                $args = $_args[ 'args' ];
                switch ( $type ){
                    case 'Collections.Foo' :
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