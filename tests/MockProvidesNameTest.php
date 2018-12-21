<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesName;

class MockProvidesNameTest extends TestCase
{



	/**
	 * @covers \calderawp\interop\Traits\ProvidesName::setName()
	 */
	public function testSetName()
	{
		$model = new MockProvidesName();
		$model = new MockProvidesName();
		$model->setName('Contact Form');
		$this->assertAttributeEquals('Contact Form', 'name', $model);

	}

	/**
	 * @covers \calderawp\interop\Traits\ProvidesName::getName
	 */
	public function testGetName()
	{
		$model = new MockProvidesName();
		$model->setName('Contact Form');
		$this->assertEquals('Contact Form', $model->getName());

	}


}
