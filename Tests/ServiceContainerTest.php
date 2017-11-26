<?php


class ServiceContainerTest extends CalderaInteropTestCase
{

    /**
     * Test we can control allowed props via constructor
     *
     * @covers \calderawp\interop\ServiceContainer::has()
     * @covers \calderawp\interop\ServiceContainer::setProps()
     * @covers \calderawp\interop\ServiceContainer::propArrayMerge()
     */
    public function testAllowedWithPassedAttributes()
    {
        $allowed = [
            'a',
            'b',
            'c'
        ];
        $container = new \calderawp\interop\ServiceContainer( $allowed );

        foreach ( $allowed as $offset )
        {
            $this->assertTrue(  $container->allowed( $offset ) );
        }

    }

    /**
     * Test that correct default allowed attributes work
     *
     * @covers \calderawp\interop\ServiceContainer::has()
     * @covers \calderawp\interop\ServiceContainer::setProps()
     * @covers \calderawp\interop\ServiceContainer::propArrayMerge()
     */
    public function testAllowedWithoutPasssedAttributes()
    {
        $allowed = [
            'industry',
            'serviceMap',
            'eventManager'
        ];
        $container = new \calderawp\interop\ServiceContainer( $allowed );

        foreach ( $allowed as $offset )
        {
            $this->assertTrue(  $container->allowed( $offset ) );
        }

    }

    /**
     * Test we get right instance from getEventsManager() method
     *
     * @covers \calderawp\interop\ServiceContainer::getEventsManager()
     */
    public function testGetEventManager()
    {
        $container = new \calderawp\interop\ServiceContainer();
        $this->assertInstanceOf(
            \calderawp\interop\Events\Events::class,
            $container->getEventsManager()
        );

        $this->assertEquals(
            $container->getEventsManager(),
            $container->getEventsManager()
        );

    }

    /**
     * Test we get right instance from getServiceMap() method
     *
     * @covers \calderawp\interop\ServiceContainer::getServiceMap()
     */
    public function testGetServiceMap()
    {
        $container = new \calderawp\interop\ServiceContainer();
        $this->assertInstanceOf(
            \calderawp\interop\ServiceMap::class,
            $container->getServiceMap()
        );

        $this->assertEquals(
            $container->getServiceMap(),
            $container->getServiceMap()
        );

    }

    /**
     * Test we get right instance from getIndustry() method
     *
     * @covers \calderawp\interop\ServiceContainer::getIndustry()
     */
    public function testGetIndustry()
    {
        $container = new \calderawp\interop\ServiceContainer();
        $this->assertInstanceOf(
            \calderawp\interop\Industry::class,
            $container->getIndustry()
        );

        $this->assertEquals(
            $container->getIndustry(),
            $container->getIndustry()
        );

    }



}