<?php


class EventTest extends CalderaInteropTestCase
{

    /**
     * Test generating from array
     *
     * @covers \calderawp\interop\Events\Event::fromArray()
     */
    public function testFromArray()
    {
        $action = [
            'name' => 'init',
            'callback' => 'foo',
            'args' => 3,
            'priority' => 5
        ];

        $event = \calderawp\interop\Events\Event::fromArray( $action );

        foreach ( $action as $prop => $value )
        {
            $this->assertEquals( $action[ $prop ], $event->$prop );
        }

    }

    /**
     * Test generating from array through maybeFromArray method
     *
     * @covers \calderawp\interop\Events\Event::maybeFromArray()
     */
    public function testMaybeFromArrayWithArray()
    {
        $action = [
            'name' => 'init',
            'callback' => 'foo',
            'args' => 3,
            'priority' => 5
        ];

        $event = \calderawp\interop\Events\Event::maybeFromArray( $action );

        foreach ( $action as $prop => $value )
        {
            $this->assertEquals( $action[ $prop ], $event->$prop );
        }

    }

    /**
     * Test that an Event passed to maybeFromArray passes through unchanged
     *
     * @covers \calderawp\interop\Events\Event::maybeFromArray()
     */
    public function testMaybeFromArrayWithObject()
    {

        $action = [
            'name' => 'init',
            'callback' => 'foo',
            'args' => 3,
            'priority' => 5
        ];

        $_event = \calderawp\interop\Events\Event::fromArray( $action );
        $event = \calderawp\interop\Events\Event::maybeFromArray( $_event );

        $this->assertEquals( $_event, $event );

        foreach ( $action as $prop => $value )
        {
            $this->assertEquals( $action[ $prop ], $event->$prop );
        }
    }

}