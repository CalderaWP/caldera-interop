<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesId;

class MockProvidesIdTest extends TestCase
{
	/**
	 * @covers \calderawp\interop\Traits\ProvidesIdToModel::getId
	 */
	public function testGetIdWithString()
	{
		$model = new MockProvidesId();
		$model->setId('x2');
		$this->assertEquals('x2', $model->getId());

	}

	/**
	 * @covers \calderawp\interop\Traits\ProvidesIdToModel::getId
	 */
	public function testGetIdWithInteger()
	{
		$model = new MockProvidesId();
		$model->setId(2);
		$this->assertEquals(2, $model->getId());

	}

	/**
	 * @covers \calderawp\interop\Traits\ProvidesIdToModel::setId
	 */
	public function testSetId()
	{
		$model = new MockProvidesId();
		$model->setId(2);
		$this->assertAttributeEquals(2, 'id', $model);
	}
}
