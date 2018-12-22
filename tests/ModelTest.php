<?php

namespace calderawp\interop\Tests;

use calderawp\caldera\Forms\FieldModel;
use calderawp\interop\CalderaForms\FormModel;
use calderawp\interop\Model;
use calderawp\interop\Tests\Mocks\MockModel;
use calderawp\interop\Tests\Mocks\MockModelCollection;
use calderawp\interop\Tests\Mocks\MockRequest;
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








}
