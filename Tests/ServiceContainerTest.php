<?php


class ServiceContainerTest extends TestCase
{

    /**
     * Test getting the service map object from container
     *
     * @covers  \calderawp\interop\ServiceContainer::getServiceMap()
     */
    public function testServiceMap()
    {
        $serviceContainer = new \calderawp\interop\ServiceContainer();

        $this->assertTrue(
            is_object(
                $serviceContainer->getServiceMap()
            )
        );

        $this->assertSame(
            $serviceContainer->getServiceMap(),
            $serviceContainer->getServiceMap()
        );

        $this->assertTrue(
            is_a(
                $serviceContainer->getServiceMap(),
                \calderawp\interop\ServiceMap::class
            )
        );

    }

    /**
     * Test getting the Industry object from container
     *
     *
     * @covers  \calderawp\interop\ServiceContainer::getIndustry()
     */
    public function testIndustry()
    {
        $serviceContainer = new \calderawp\interop\ServiceContainer();

        $this->assertTrue(
            is_object(
                $serviceContainer->getIndustry()
            )
        );

        $this->assertSame(
            $serviceContainer->getIndustry(),
            $serviceContainer->getIndustry()
        );

        $this->assertTrue(
            is_a(
                $serviceContainer->getIndustry(),
                \calderawp\interop\Industry::class
            )
        );

    }

}