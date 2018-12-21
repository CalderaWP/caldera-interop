<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesHasField;
use calderawp\interop\Contracts\CalderaForms\HasField;

class MockProvidesFieldTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesField::getField();
	 */
	public function testGetField()
	{
		$field = \Mockery::mock( 'Field', HasField::class );
		$hasField = new MockProvidesHasField();
		$hasField->setField($field);
		$this->assertEquals($field, $hasField->getField() );

	}

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesField::setField();
	 */
	public function testSetField()
	{
		$field = \Mockery::mock( 'Field', HasField::class );
		$hasField = new MockProvidesHasField();
		$hasField->setField($field);
		$this->assertAttributeEquals($field, 'field', $hasField );
	}
}
