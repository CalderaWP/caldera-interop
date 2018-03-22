<?php


class ServiceContainerTest extends CalderaInteropTestCase
{

    /**
     *
     * @covers ServiceContainer::bind()
     * @covers ServiceContainer::make()
     */
    public function testRegisterProvider()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\ServiceContainer();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $this->assertSame( $classRef, get_class( $container->make($classRef )) );
    }

    /**
     *
     * @covers ServiceContainer::bind()
     * @covers ServiceContainer::make()
     */
    public function testRegisterTwoProviders()
    {
        $classRef1 = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\ServiceContainer();
        $container->bind( $classRef1, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $classRef2 = \calderawp\interop\Entities\Field::class;
        $container->bind( $classRef2, function (){
            return new \calderawp\interop\Collections\EntityCollections\Fields();
        });

        $this->assertSame( $classRef1, get_class( $container->make($classRef1 )) );
        $this->assertSame( $classRef2, get_class( $container->make($classRef2 )) );
    }

    /**
     * Test that each object returned by bind, that is not set to be a singleton
     *
     * @covers ServiceContainer::bind()
     * @covers ServiceContainer::make()
     */
    public function testBindNotSingleton()
    {

        $classRef1 = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\ServiceContainer();
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
     * @covers ServiceContainer::singleton()
     * @covers ServiceContainer::bind()
     * @covers ServiceContainer::make()
     */
    public function testSingleton()
    {
        $container = new \calderawp\interop\ServiceContainer();

        $classRef = \calderawp\interop\Entities\Field::class;
        $container->singleton( $classRef, function (){
            return new \calderawp\interop\Collections\EntityCollections\Fields();
        });

        $this->assertSame( $container->make($classRef), $container->make($classRef));

    }

}