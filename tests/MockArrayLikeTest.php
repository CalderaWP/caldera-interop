<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockArrayLike;
use PHPUnit\Framework\TestCase;

class MockArrayLikeTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\ArrayLike::__construct()
	 */
	public function test__construct()
	{
		$items = [
			'x',
			'z' => 11,
		];
		$arrayLike = new MockArrayLike($items);
		$this->assertAttributeEquals($items, 'items', $arrayLike );

	}

	/**
	 * @covers \calderawp\interop\ArrayLike::toArray()
	 */
	public function testToArray()
	{
		$items = [
			'xzz',
			'aaa' => 11,
		];
		$arrayLike = new MockArrayLike($items);
		$this->assertSame($items,$arrayLike->toArray());
	}
}
