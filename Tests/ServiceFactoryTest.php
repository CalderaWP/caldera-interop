<?php


class ServiceFactoryTest extends CalderaInteropTestCase
{

    /**
     * Test we can get a valid entity from factory
     *
     * @covers \calderawp\interop\Service\Factory::entity()
     */
    public function testValidEntity()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $factory = new \calderawp\interop\Service\Factory($container);
        $entity = $factory->entity( $classRef );

        $this->assertSame( $classRef, get_class( $entity ) );

    }

    /**
     * Test invalid entry throws exception
     *
     * @covers \calderawp\interop\Service\Factory::entity()
     * @covers \calderawp\interop\Service\Container::doesProvide()
     */
    public function testInvalidEntity(){
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $factory = new \calderawp\interop\Service\Factory($container);
        $this->setExpectedException( \calderawp\interop\Exceptions\ContainerException::class );
        $factory->entity( \calderawp\interop\Mock\Entity::class );
    }

    public function testFromArray()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $args = $this->formArrayFactory('CF13333' );
        $factory = new \calderawp\interop\Service\Factory($container);
        $entity = $factory->entity( $classRef, $args );
        $this->assertSame( $args['name'], $entity->name );
    }

    public function testFromRequest()
    {
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $classRef, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $factory = new \calderawp\interop\Service\Factory($container);

        $entity = $this->entityFactory( 'Form' );
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://roysivan.com', [], json_encode( $entity ) );
        $entityFromRequest = $factory->entity( $classRef, $request );
        $this->assertEquals( $entity->toArray(), $entityFromRequest->toArray() );


    }
}