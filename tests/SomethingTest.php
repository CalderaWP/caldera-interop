<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Something;
use PHPUnit\Framework\TestCase;
use \Mockery as m;



class SomethingTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Something::hiRoy()
	 */
	public function testHiRoy()
	{

		$this->assertSame('Hi Roy', (new Something())->hiRoy());
	}

	public function testInterfaceMock() {
		/** @var \calderawp\interop\Contracts\CalderaForms\HasFields $fields */
		$fields = \Mockery::mock('MockFields'
			//,\calderawp\interop\Contracts\CalderaForms\Fields::class
		);
		/** @var \calderawp\interop\Contracts\CalderaForms\HasField $field */
		$field = \Mockery::mock('MockField'
			//\calderawp\interop\Contracts\CalderaForms\Field::class
		);

		$fields->shouldReceive('getField' )->andReturn($field);


		$mockResult = $fields->getField('');

		//$this->assertInstanceOf(\calderawp\interop\Contracts\CalderaForms\Field::class,$mockResult);

		$fields->shouldReceive('hasField' )->andReturn(false);
		$this->assertFalse( $fields->hasField() );

	}

	public function testSimpleMock() {
		$mock = \Mockery::mock('MyClass');

		$mock->shouldReceive('foo')->andReturn(43);

		$mockResult = $mock->foo();

		$this->assertSame(43,$mockResult);

	}

	public function tearDown() {
		m::close();
	}
}
