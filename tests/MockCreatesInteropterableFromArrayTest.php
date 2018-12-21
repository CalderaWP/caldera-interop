<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockCreatesInteroperableFromArray;

class MockCreatesInteropterableFromArrayTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Tests\Mocks\MockCreatesInteroperableFromArray::__set()
	 */
	public function test__set()
	{
		$obj = new MockCreatesInteroperableFromArray();
		$obj->one = 'one';
		$obj->three = 'three';
		$this->assertAttributeEquals('one', 'one', $obj );
	}

	/**
	 * @covers \calderawp\interop\Tests\Mocks\MockCreatesInteroperableFromArray::fromArray()
	 */
	public function testFromArray()
	{
		$obj = MockCreatesInteroperableFromArray::fromArray([
			'one' => '_1one',
			'two' => '_2two',
			'hats' => 'adsadsadsgd'
		]);
		$this->assertAttributeEquals('_1one', 'one', $obj );
		$this->assertAttributeEquals('_2two', 'two', $obj );

	}

	public function testCallsSetter()
	{
		$obj = new MockCreatesInteroperableFromArray();
		$obj->otherProp = 2;
		$this->assertAttributeEquals(4, 'otherProp', $obj );


	}
}
