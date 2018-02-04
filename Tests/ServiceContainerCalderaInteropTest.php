<?php


class ServiceContainerCalderaInteropTest extends CalderaInteropTestCase
{

    /**
     * Test getting the service map object from container
     *
     * @covers  \calderawp\interop\ServiceControlledContainer::getServiceMap()
     */
    public function testServiceMap()
    {
        $serviceContainer = new \calderawp\interop\ServiceControlledContainer();

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
     * @covers  \calderawp\interop\ServiceControlledContainer::getIndustry()
     */
    public function testIndustry()
    {
        $serviceContainer = new \calderawp\interop\ServiceControlledContainer();

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