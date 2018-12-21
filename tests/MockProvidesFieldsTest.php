<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesHasFields;
use calderawp\interop\Contracts\CalderaForms\HasFields;

class MockProvidesFieldTests extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesField::getFields();
	 */
	public function testGetField()
	{
		$fields = \Mockery::mock( 'Fields', HasFields::class );
		$hasFields = new MockProvidesHasFields();
		$hasFields->setFields($fields);
		$this->assertSame($fields, $hasFields->getFields() );

	}

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesField::setFields();
	 */
	public function testSetField()
	{
		$fields = \Mockery::mock( 'Field', HasFields::class );
		$hasFields = new MockProvidesHasFields();
		$hasFields->setFields($fields);
		$this->assertAttributeEquals($fields, 'fields', $hasFields );
	}
}
