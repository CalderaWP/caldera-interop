<?php

class CalderaFormsTest extends CalderaInteropTestCase
{

	/**
	 *
	 * @covers CalderaForms::registerInterops()
	 * @covers CalderaForms::getFactory()
	 */
	public function testFactory()
	{
		$calderaForms = $this->createApp();

		$this->assertSame(
			\calderawp\interop\Entities\Field::class,
			get_class(
				$calderaForms
				->getFactory()
				->entity( 'field' )
			)
		);

	}

	/**
	 * Test interop bind for fields
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 */
	public function testBindField()
	{
		$identifier = 'field';
		$entityClassRef = \calderawp\interop\Entities\Field::class;
		$modelClassRef = \calderawp\interop\Models\Field::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\Fields::class;

		$calderaForms = $this->createApp();

		$this->assertSame( $entityClassRef, get_class( $calderaForms->getFactory()->entity( $identifier)));
		$this->assertSame( $modelClassRef, get_class( $calderaForms->getFactory()->model( $calderaForms->getFactory()->entity( $identifier))));
		$this->assertSame( $collectionClassRef, get_class( $calderaForms->getFactory()->collection( $identifier)));
		$calderaForms->getFactory()->collection($identifier );

	}

	/**
	 * Test interop bind for forms
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 */
	public function testBindForm()
	{
		$identifier = 'form';
		$entityClassRef = \calderawp\interop\Entities\Form::class;
		$modelClassRef = \calderawp\interop\Models\Form::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\Forms::class;

		$calderaForms = $this->createApp();

		$this->assertSame( $entityClassRef, get_class( $calderaForms->getFactory()->entity( $identifier)));
		$this->assertSame( $modelClassRef, get_class( $calderaForms->getFactory()->model( $calderaForms->getFactory()->entity( $identifier))));
		$this->assertSame( $collectionClassRef, get_class( $calderaForms->getFactory()->collection( $identifier)));
		$calderaForms->getFactory()->collection($identifier );

	}

	/**
	 * Test interop bind for entries
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 */
	public function testBindEntries()
	{
		$identifier = 'entry';
		$entityClassRef = \calderawp\interop\Entities\Entry::class;
		$modelClassRef = \calderawp\interop\Models\Entry::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\Entries::class;

		$calderaForms = $this->createApp();

		$this->assertSame( $entityClassRef, get_class( $calderaForms->getFactory()->entity( $identifier)));
		$this->assertSame( $modelClassRef, get_class( $calderaForms->getFactory()->model( $calderaForms->getFactory()->entity( $identifier))));
		$this->assertSame( $collectionClassRef, get_class( $calderaForms->getFactory()->collection( $identifier)));
		$calderaForms->getFactory()->collection($identifier );

	}

	/**
	 * Test service providing/registration
	 *
	 * @covers CalderaForms::registerProvider()
	 * @covers CalderaForms::getService()
	 * @covers ServiceContainer::make()
	 */
	public function testServiceRegistration()
	{
		$calderaForms = $this->createApp();
		$provider = new \calderawp\interop\Mock\Provider();
		$calderaForms->registerProvider($provider);
		$this->assertEquals(
			new stdClass(),
			$calderaForms->getService($provider->getAlias() )
		);

	}

	/**
	 * @return \calderawp\interop\CalderaForms
	 */
	protected function createApp()
	{
		$interopContainer = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($interopContainer);
		$serviceContainer = new \calderawp\CalderaContainers\Service\Container();
		$calderaForms = new \calderawp\interop\CalderaForms($factory, $serviceContainer);
		return $calderaForms;
	}



}