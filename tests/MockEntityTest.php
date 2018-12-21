<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockEntity;

class MockEntityTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Entity::getDefault()
	 * @covers \calderawp\interop\Entity::setDefault()
	 * @covers \calderawp\interop\Traits\ProvidesValue::getDefault()
	 * @covers \calderawp\interop\Traits\ProvidesValue::setDefault()
	 */
	public function testGetDefault()
	{
		$entity = new MockEntity();
		$entity->setDefault('x1' );
		$this->assertEquals('x1', $entity->getDefault() );

		$entity = new MockEntity();
		$entity->setDefault(1 );
		$this->assertEquals(1, $entity->getDefault() );

		$entity = new MockEntity();
		$entity->setDefault([1,'x2'] );
		$this->assertEquals([1,'x2'], $entity->getDefault() );
	}

	/**
	 * @covers \calderawp\interop\Entity::getValue()
	 * @covers \calderawp\interop\Entity::setValue()
	 * @covers \calderawp\interop\Traits\ProvidesValue::getValue()
	 * @covers \calderawp\interop\Traits\ProvidesValue::setValue()
	 */
	public function testGetValue()
	{
		$entity = new MockEntity();
		$entity->setValue('x1' );
		$this->assertEquals('x1', $entity->getValue() );

		$entity = new MockEntity();
		$entity->setValue(1 );
		$this->assertEquals(1, $entity->getValue() );

		$entity = new MockEntity();
		$entity->setValue([1,'x2'] );
		$this->assertEquals([1,'x2'], $entity->getValue() );
	}

	/**
	 * @covers \calderawp\interop\Entity::getDefault()
	 * @covers \calderawp\interop\Entity::setDefault()
	 * @covers \calderawp\interop\Traits\ProvidesValue::getDefault()
	 * @covers \calderawp\interop\Traits\ProvidesValue::setDefault()
	 * @covers \calderawp\interop\Entity::getValue()
	 * @covers \calderawp\interop\Entity::setValue()
	 * @covers \calderawp\interop\Traits\ProvidesValue::getValue()
	 * @covers \calderawp\interop\Traits\ProvidesValue::setValue()
	 */
	public function testGetValueWhenNoValueReturnsDefault()
	{
		$entity = new MockEntity();
		$entity->setDefault('x1' );
		$this->assertEquals('x1', $entity->getValue() );

		$entity = new MockEntity();
		$entity->setDefault(1 );
		$this->assertEquals(1, $entity->getValue() );

		$entity = new MockEntity();
		$entity->setDefault([1,'x2'] );
		$this->assertEquals([1,'x2'], $entity->getValue() );
	}


}
