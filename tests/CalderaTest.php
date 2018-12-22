<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Caldera;
use calderawp\interop\Tests\Mocks\MockCaldera;
use calderawp\interop\Tests\Traits\EntityFactory;

class CalderaTest extends TestCase
{

	use EntityFactory;

	/**
	 * @covers \calderawp\interop\Caldera::toArray();
	 */
	public function testToArray()
	{
		$forms = $this->getForms();
		$forms->shouldReceive( 'toArray' )->andReturn([]);
		$settings = $this->getSettings();
		$settings->shouldReceive( 'toArray' )->andReturn([]);
		$id = $this->createFormId();
		$name = 'Contact Forms';
		$model = MockCaldera::fromArray([
			'id' => $id,
			'name' => $name,
			'forms' => $forms,
			'settings' => $settings,
		]);
		$array = $model->toArray();
		$this->assertEquals($id, $array['id'] );
		$this->assertEquals($name, $array['name'] );
		$this->assertEquals([], $array['settings'] );
		$this->assertEquals([], $array['forms'] );

	}

	/**
	 * @covers \calderawp\interop\Model::fromArray();
	 */
	public function testFromArray()
	{
		$forms = $this->getForms();
		$settings = $this->getSettings();
		$id = $this->createFormId();
		$name = 'Contact Forms';
		$model = MockCaldera::fromArray([
			'id' => $id,
			'name' => $name,
			'forms' => $forms,
			'settings' => $settings,
		]);
		$this->assertAttributeEquals($id, 'id', $model);
		$this->assertAttributeEquals($name, 'name', $model);
		$this->assertAttributeEquals($forms, 'forms', $model);
		$this->assertAttributeEquals($settings, 'settings', $model);
	}

	/**
	 * @covers \calderawp\interop\Model::getForms();
	 */
	public function testGetForms()
	{
		$forms = $this->getForms();
		$settings = $this->getSettings();
		$id = $this->createFormId();
		$name = 'Contact Forms';
		$model = MockCaldera::fromArray([
			'id' => $id,
			'name' => $name,
			'forms' => $forms,
			'settings' => $settings,
		]);
		$this->assertEquals($forms, $model->getForms() );
	}

	/**
	 * @covers \calderawp\interop\Model::setForms();
	 */
	public function testSetForms()
	{
		$forms = $this->getForms();
		$id = $this->createFormId();
		$name = 'Contact Forms';
		$model = MockCaldera::fromArray([
			'id' => $id,
			'name' => $name,
		]);
		$model->setForms($forms);
		$this->assertAttributeEquals($forms, 'forms', $model );
	}


}
