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
        $ref = 'form.entity';
        $classRef = \calderawp\interop\Entities\Form::class;
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $ref, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $factory = new \calderawp\interop\Service\Factory($container);
        $entity = $factory->entity( 'form' );

        $this->assertSame( $classRef, get_class( $entity ) );

    }

    /**
     * Test invalid entry throws exception
     *
     * @covers \calderawp\interop\Service\Factory::entity()
     * @covers \calderawp\interop\Service\Container::doesProvide()
     */
    public function testInvalidEntity(){
        $ref = 'form.entity';
        $container = new \calderawp\interop\Service\Container();
        $container->bind( $ref, function (){
            return new \calderawp\interop\Entities\Form();
        });

        $factory = new \calderawp\interop\Service\Factory($container);
        $this->setExpectedException( \calderawp\interop\Exceptions\ContainerException::class );
        $factory->entity( \calderawp\interop\Mock\Entity::class );
    }


	/**
	 * Covers features of container/factory that must work for interop Bindings to function
	 *
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 */
    public function testInteropBind()
	{
		$ref = 'form.entity';
		$container = new \calderawp\interop\Service\Container();
		$classRef = \calderawp\interop\Entities\Form::class;
		$container->bind( $ref, function () use ($classRef){
			return new $classRef;
		});
		$factory = new \calderawp\interop\Service\Factory($container);


		$this->assertSame( $classRef, get_class( $container->make($ref) ) );

		$entity = $factory->entity( 'form' );

		$this->assertSame( $classRef, get_class( $entity ) );

		$this->assertTrue( is_callable( function(){return 42;}));

	}

	/**
	 * Covers using interop binding method to bind
	 *
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 */
	public function testInteropBindings()
	{
		$identifier = 'field';
		$container = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($container);
		$factory->bindInterop(
			$identifier,
			\calderawp\interop\Entities\Field::class,
			\calderawp\interop\Models\Field::class,
			\calderawp\interop\Collections\EntityCollections\Fields::class
		);

		$this->assertSame(
			\calderawp\interop\Entities\Field::class,
			get_class( $container->make($factory->entityRef($identifier) )  )
		);

		$this->assertSame(
			\calderawp\interop\Models\Field::class,
			get_class( $container->make( $factory->modelRef($identifier) ) )
		);

		$this->assertSame(
			\calderawp\interop\Collections\EntityCollections\Fields::class,
			get_class( $container->make( $factory->collectionRef($identifier) ) )
		);

	}

	/**
	 * Test getting interoperable entity
	 *
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 * @covers \calderawp\interop\Service\Factory::isProvidedEntity()
	 * @covers \calderawp\interop\Service\Factory::entityRef()
	 */
	public function testEntityBind()
	{
		$identifier = 'field';
		$container = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($container);
		$factory->bindInterop(
			$identifier,
			\calderawp\interop\Entities\Field::class,
			\calderawp\interop\Models\Field::class,
			\calderawp\interop\Collections\EntityCollections\Fields::class
		);

		$entity = $factory->entity($identifier);
		$this->assertSame(
			\calderawp\interop\Entities\Field::class,
			get_class(  $entity  )
		);


		/** @var \calderawp\interop\Entities\Field $entity */
		$entity = $this->entityFactory( 'FIELD' );
		$request = new \GuzzleHttp\Psr7\Request('GET', 'https://roysivan.com', [], json_encode( $entity ) );


		/** @var \calderawp\interop\Entities\Field $entity */
		$entityFromRequest = $factory->entity( $identifier, $request );
		$this->assertEquals( $entity->getSlug(), $entityFromRequest->getSlug() );
		$this->assertEquals( $entity->toArray(), $entityFromRequest->toArray() );
		$this->assertEquals( $entity->getId(), $entityFromRequest->getId() );


	}

	/**
	 * Test getting interoperable model
	 *
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 * @covers \calderawp\interop\Service\Factory::isProvidedModel()
	 * @covers \calderawp\interop\Service\Factory::modelRef()
	 */
	public function testModelBind()
	{
		$identifier = 'field';
		$container = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($container);
		$factory->bindInterop(
			$identifier,
			\calderawp\interop\Entities\Field::class,
			\calderawp\interop\Models\Field::class,
			\calderawp\interop\Collections\EntityCollections\Fields::class
		);

		$entity = $factory->entity($identifier );

		/** @var \calderawp\interop\Models\Model $model */
		$model = $factory->model($entity );
		$this->assertSame(
			\calderawp\interop\Models\Field::class,
			get_class(  $model  )
		);

		$this->assertSame(
			$entity,
			$model->getEntity()
		);
	}


	/**
	 * Test creating entity from array
	 * @covers \calderawp\interop\Service\Factory::entity()
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 */
	public function testFromArray()
	{
		$identifier = 'field';
		$container = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($container);
		$factory->bindInterop(
			$identifier,
			\calderawp\interop\Entities\Field::class,
			\calderawp\interop\Models\Field::class,
			\calderawp\interop\Collections\EntityCollections\Fields::class
		);


		$args = $this->fieldArrayFactory('cld13333' );

		/** @var \calderawp\interop\Entities\Field $entity */
		$entity = $factory->entity( $identifier, $args );
		$this->assertSame( $args['slug'], $entity->getSlug() );
	}


	/**
	 * Test creating entity from Request
	 *
	 * @covers \calderawp\interop\Service\Factory::entity()
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 */
	public function testFromRequest()
	{
		$identifier = 'field';
		$container = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($container);
		$factory->bindInterop(
			$identifier,
			\calderawp\interop\Entities\Field::class,
			\calderawp\interop\Models\Field::class,
			\calderawp\interop\Collections\EntityCollections\Fields::class
		);

		/** @var \calderawp\interop\Entities\Field $entity */
		$entity = $this->entityFactory( 'FIELD' );
		$request = new \GuzzleHttp\Psr7\Request('GET', 'https://roysivan.com', [], json_encode( $entity ) );


		/** @var \calderawp\interop\Entities\Field $entity */
		$entityFromRequest = $factory->entity( $identifier, $request );
		$this->assertEquals( $entity->getSlug(), $entityFromRequest->getSlug() );
		$this->assertEquals( $entity->toArray(), $entityFromRequest->toArray() );

	}

	/**
	 * Test creating Collection from factory
	 *
	 * @covers \calderawp\interop\Service\Factory::collection()
	 * @covers \calderawp\interop\Service\Factory::bindInterop()
	 */
	public function testCollection()
	{
		$identifier = 'field';
		$container = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($container);
		$factory->bindInterop(
			$identifier,
			\calderawp\interop\Entities\Field::class,
			\calderawp\interop\Models\Field::class,
			\calderawp\interop\Collections\EntityCollections\Fields::class
		);

		$collection = $factory->collection($identifier);
		$this->assertSame(
			\calderawp\interop\Collections\EntityCollections\Fields::class,
			get_class( $collection )
		);
	}

}