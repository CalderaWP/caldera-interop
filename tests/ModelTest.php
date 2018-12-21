<?php

namespace calderawp\interop\Tests;

use calderawp\interop\CalderaForms\FormModel;
use calderawp\interop\Model;
use calderawp\interop\Tests\Mocks\MockModel;
use calderawp\interop\Tests\Mocks\MockModelCollection;
use calderawp\interop\Tests\Traits\EntityFactory;

class ModelTest extends TestCase
{

	use EntityFactory;

	/**
	 * @covers \calderawp\interop\Model::fromArray();
	 */
	public function testFromArray()
	{
		$id = $this->createFormId();
		$name = 'Contact Forms';
		$model = MockModel::fromArray([
			'id' => $id,
			'name' => $name,
		]);
		$this->assertAttributeEquals($id, 'id', $model);
		$this->assertAttributeEquals($name, 'name', $model);
	}

	/**
	 * @covers \calderawp\interop\Model::toArray();
	 */
	public function testToArray()
	{
		$form = $this->getForm();
		$fields = $this->getFields();
		$settings = $this->getSettings();
		$id = $this->createFormId();
		$name = 'Contact Forms';
		$model = MockModel::fromArray([
			'id' => $id,
			'name' => $name,
		]);
		$array = $model->toArray();
		$this->assertEquals($id, $array['id'] );
		$this->assertEquals($name, $array['name'] );
	}
}
