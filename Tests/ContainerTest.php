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

        $container = new \calderawp\interop\Mock\Container();
        $container[ 'x' ] = 1;
        $this->assertEquals( 1, $container[ 'x' ] );
        $this->assertEquals( $container->get('x'), $container[ 'x' ] );


        $container = new \calderawp\interop\Mock\Container();
        $y = new stdClass();
        $y->x = 1;
        $container->set( 'y', $y );
        $this->assertSame( $y, $container->get( 'y' ) );



    }

    /**
     * @covers \calderawp\interop\Container::has()
     * @covers \calderawp\interop\Container::offsetExists()
     */
    public function testHas()
    {
        $container = new \calderawp\interop\Mock\Container();
        $container[ 'x' ] = 1;
        $this->assertTrue( $container->has('x' ) );
        $this->assertFalse( $container->has('y' ) );
    }

    /**
     * @covers \calderawp\interop\Container::has()
     * @covers \calderawp\interop\Container::offsetUnset()
     */
    public function testUnset()
    {
        $container = new \calderawp\interop\Mock\Container();
        $container[ 'x' ] = 1;
        unset( $container['x'] );
        $this->assertFalse( $container->has('x' ) );
    }
}