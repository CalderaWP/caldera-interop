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
					->entity('field')
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
		$identifier = \calderawp\interop\CalderaForms::FIELD;
		$entityClassRef = \calderawp\interop\Entities\Field::class;
		$modelClassRef = \calderawp\interop\Models\Field::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\Fields::class;

		$calderaForms = $this->createApp();

		$this->assertSame($entityClassRef, get_class($calderaForms->getFactory()->entity($identifier)));
		$this->assertSame($modelClassRef,
			get_class($calderaForms->getFactory()->model($calderaForms->getFactory()->entity($identifier))));
		$this->assertSame($collectionClassRef, get_class($calderaForms->getFactory()->collection($identifier)));
		$calderaForms->getFactory()->collection($identifier);

	}

	/**
	 * Test interop bind for forms
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 * @covers \calderawp\interop\Providers\FormInteroperableProvider()
	 * @covers \calderawp\interop\Providers\FormInteroperableProvider::bindInterop()
	 */
	public function testBindForm()
	{
		$identifier = \calderawp\interop\CalderaForms::FORM;
		$entityClassRef = \calderawp\interop\Entities\Form::class;
		$modelClassRef = \calderawp\interop\Models\Form::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\Forms::class;

		$calderaForms = $this->createApp();

		$this->assertSame($entityClassRef, get_class($calderaForms->getFactory()->entity($identifier)));
		$this->assertSame($modelClassRef,
			get_class($calderaForms->getFactory()->model($calderaForms->getFactory()->entity($identifier))));
		$this->assertSame($collectionClassRef, get_class($calderaForms->getFactory()->collection($identifier)));
		$calderaForms->getFactory()->collection($identifier);

	}

	/**
	 * Test interop bind for entries
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 */
	public function testBindEntries()
	{
		$identifier = \calderawp\interop\CalderaForms::ENTRY;
		$entityClassRef = \calderawp\interop\Entities\Entry::class;
		$modelClassRef = \calderawp\interop\Models\Entry::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\Entries::class;

		$calderaForms = $this->createApp();

		$this->assertSame($entityClassRef, get_class($calderaForms->getFactory()->entity($identifier)));
		$this->assertSame($modelClassRef,
			get_class($calderaForms->getFactory()->model($calderaForms->getFactory()->entity($identifier))));
		$this->assertSame($collectionClassRef, get_class($calderaForms->getFactory()->collection($identifier)));
		$calderaForms->getFactory()->collection($identifier);

	}

	/**
	 * Test interop bind for entry field values
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 */
	public function testEntryValueBind()
	{
		$identifier = \calderawp\interop\CalderaForms::ENTRY_VALUE;
		$entityClassRef = \calderawp\interop\Entities\Entry\Field::class;
		$modelClassRef = \calderawp\interop\Models\Entry\Field::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class;

		$calderaForms = $this->createApp();

		$this->assertSame($entityClassRef, get_class($calderaForms->getFactory()->entity($identifier)));
		$this->assertSame($modelClassRef, get_class($calderaForms->getFactory()->model($calderaForms->getFactory()->entity($identifier))));
		$this->assertSame($collectionClassRef, get_class($calderaForms->getFactory()->collection($identifier)));
		$calderaForms->getFactory()->collection($identifier);
	}

	/**
	 * Test interop bind for entry field details
	 *
	 * @covers \calderawp\interop\CalderaForms::registerInterops()
	 */
	public function testEntryValueDetails()
	{
		$identifier = \calderawp\interop\CalderaForms::ENTRY_DETAILS;
		$entityClassRef = \calderawp\interop\Entities\Entry\Details::class;
		$modelClassRef = \calderawp\interop\Models\Entry\Details::class;
		$collectionClassRef = \calderawp\interop\Collections\EntityCollections\EntryValues\Details::class;

		$calderaForms = $this->createApp();

		$this->assertSame($entityClassRef, get_class($calderaForms->getFactory()->entity($identifier)));
		$this->assertSame($modelClassRef, get_class(
				$calderaForms->getFactory()->model(
					$calderaForms->getFactory()->entity($identifier)
				)
			)
		);
		$this->assertSame($collectionClassRef, get_class($calderaForms->getFactory()->collection($identifier)));
		$calderaForms->getFactory()->collection($identifier);
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
			$calderaForms->getService($provider->getAlias())
		);
	}

	/**
	 * Ensure we have singleton bound main CF app ref properly
	 *
	 * @covers CalderaForms::bindSelf()
	 */
	public function testCFBinding()
	{
		$identifier = \calderawp\interop\CalderaForms::CALDERA_FORMS;
		$calderaForms = $this->createApp();
		$this->assertSame( $calderaForms->getService($identifier ), $calderaForms );

		$this->assertSame( $calderaForms->getService($identifier ), $calderaForms );
		/** @var \calderawp\interop\CalderaForms $app */
		$app = $calderaForms->getService($identifier );
		$this->assertSame( $calderaForms->getService($identifier ), $calderaForms->getService('CF' ) );

	}



}