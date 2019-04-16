<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockSimpleEntity;

class MoTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\SimpleEntity::fromArray()
	 * @covers \calderawp\interop\SimpleEntity::__set()
	 * @covers \calderawp\interop\SimpleEntity::__get()
	 */
	public function testFromArray(){
		$entity = MockSimpleEntity::fromArray(['id' => 's', 'name' => 'r']);
		$this->assertEquals('s', $entity->getId());
		$this->assertEquals('s', $entity->id);
		$this->assertEquals('r', $entity->name);

	}

	/**
	 * @covers \calderawp\interop\SimpleEntity::toArray()
	 * @covers \calderawp\interop\SimpleEntity::__set()
	 * @covers \calderawp\interop\SimpleEntity::__get()
	 */
	public function testToArray(){
		$entity = new MockSimpleEntity;
		$entity->setId('s');
		$entity->name = 'r';
		$this->assertEquals(['id' => 's', 'name' => 'r'], $entity->toArray());
	}
}
