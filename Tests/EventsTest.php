<?php


class EventsTest extends CalderaInteropTestCase
{

    /**
     * Test that we can add and apply a filter without WordPress
     *
     * @covers \calderawp\interop\Events\Events::addFilter()
     * @covers \calderawp\interop\Events\Events::applyFilters()
     */
    public function testFilters()
    {
        $value = [1,2];
        $args = [3,4];
        $filter = [
            'name' => 'the_content',
            'callback' => function($a, $b) use( $value, $args ){
                $this->assertSame( $a, $value );
                $this->assertSame( $b, $args );
                return 42;
            },
            'args' => 2,
            'priority' => 5
        ];

        $event = \calderawp\interop\Events\Event::fromArray( $filter );
        $events = new \calderawp\interop\Events\Events( new \NetRivet\WordPress\EventEmitter() );


        $events->addFilter( $event );
        $result = $events->applyFilters( $event, $value, $args );
        $this->assertSame( 42, $result );

    }

    /**
     * Test that we can add and do an action without WordPress
     *
     * @covers \calderawp\interop\Events\Events::addAction()
     * @covers \calderawp\interop\Events\Events::doAction()
     */
    public function testActions()
    {

        $args = [3,4];

        $action = [
            'name' => 'init',
            'callback' => function($b) use( $args ){
                $this->assertSame( $b, $args );
            },
            'args' => 3,
            'priority' => 5
        ];

        $event = \calderawp\interop\Events\Event::fromArray( $action );

        $events = new \calderawp\interop\Events\Events( new \NetRivet\WordPress\EventEmitter() );
        $events->addAction( $event );
        $events->doAction( $event, $args );

    }

}