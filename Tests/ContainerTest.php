<?php


class ContainerTest extends CalderaInteropTestCase
{

    /**
     *
     * @covers \calderawp\interop\Container::get()
     * @covers \calderawp\interop\Container::set()
     * @covers \calderawp\interop\Container::offsetGet()
     * @covers \calderawp\interop\Container::offsetSet()
     */
    public function testSet()
    {
        $container = new \calderawp\interop\Mock\Container();
        $container->set('hi', 'roy' );
        $this->assertEquals( $container[ 'hi'], $container->get('hi' ) );
    }

}