<?php

class ModelTest extends ModelTestCase
{

	/**
	 * Test set then get of model id
	 *
	 * @covers \calderawp\interop\Models\Model::getId()
	 * @covers \calderawp\interop\Models\Model::setId()
	 */
	public function testIdSet()
	{
		$field = new class extends  \calderawp\interop\Models\Model {};
		$field->setId(42);
		$this->assertEquals(42, $field->getId());
	}

	/**
	 * Test getId() from internal property.
	 *
	 * @requires PHP 7.0
	 * @covers \calderawp\interop\Models\Model::getId()
	 */
	public function testIdGet()
	{
		$field = new class extends  \calderawp\interop\Models\Model {
			protected  $id = 42;
		};

		$this->assertEquals(42, $field->getId());
	}
}