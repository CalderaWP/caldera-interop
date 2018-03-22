<?php


class ServiceContainerTest extends CalderaInteropTestCase
{

    /**
     * Test provider registration
     *
     * @covers Container::bind()
     * @covers Container::make()
     */
    public function testRegisterProvider()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $this->assertSame( $classRef, get_class( $container->make($classRef )) );
    }

    /**
     *
     * @covers Container::bind()
     * @covers Container::make()
     */
    public function testRegisterTwoProviders()
    {
        $classRef1 = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef1, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $classRef2 = \calderawp\interop\Collections\EntityCollections\Fields::class;
        $container->bind( $classRef2, function (){
            return new \calderawp\interop\Collections\EntityCollections\Fields();
        });

        $this->assertSame( $classRef1, get_class( $container->make($classRef1 )) );
        $this->assertSame( $classRef2, get_class( $container->make($classRef2 )) );
    }

    /**
     * Test that each object returned by bind, that is not set to be a singleton
     *
     * @covers Container::bind()
     * @covers Container::make()
     */
    public function testBindNotSingleton()
    {

        $classRef1 = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef1, function (){
            $entity = new \calderawp\interop\Entities\Form();
            $field = new \calderawp\interop\Entities\Field([
                'ID' => uniqid( 'cf' )
            ]);
            $entity->addField($field);
            return $field;
        });

        $this->assertNotEquals( $container->make($classRef1),$container->make($classRef1));

    }

    /**
     * Test that objects bound as singletons always return the same instance
     *
     * @covers Container::singleton()
     * @covers Container::bind()
     * @covers Container::make()
     */
    public function testSingleton()
    {
        $container = new \calderawp\interop\Service\Container();

        $classRef = \calderawp\interop\Entities\Field::class;
        $container->singleton( $classRef, new \calderawp\interop\Collections\EntityCollections\Fields()
        );

        $this->assertSame( $container->make($classRef), $container->make($classRef));

    }

    /**
     * Test that container reports invalid entities are not provided
     *
     * @covers  \calderawp\interop\Service\Container::doesProvide()
     */
    public function testInvalidEntity()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $this->assertTrue( $container->doesProvide( $classRef ) );
        $this->assertFalse( $container->doesProvide( 'Form' ) );
        $this->assertFalse( $container->doesProvide( \calderawp\interop\Mock\Entity::class ) );
    }

    /**
     * Test that container reports it doesn't provide an entity when no services are registered.
     *
     * Test ensures that doesProvide does not treat null as array
     *
     * @covers  \calderawp\interop\Service\Container::doesProvide()
     */
    public function testNoEntity()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $this->assertFalse( $container->doesProvide( $classRef ) );
        $this->assertFalse( $container->doesProvide( \calderawp\interop\Mock\Entity::class ) );
    }

}