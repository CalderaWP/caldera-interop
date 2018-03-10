<?php
class EntityTest extends EntityCalderaInteropTestCase
{

	/**
	 * Test getting ID of entity
	 *
	 *
	 * @covers \calderawp\interop\Entities\Entity::getId()
	 */
	public function testGetId()
	{
		$entity = $this->entityFactory('Generic', 42);
		$this->assertEquals(42, $entity->getId());
	}

	/**
	 * Test setting ID of entity
	 *
	 *
	 * @covers \calderawp\interop\Entities\Entity::setId()
	 */
	public function testSetId()
	{
		$entity = $this->entityFactory('Generic', 42);
		$entity->setId(21);
		$this->assertEquals(21, $entity->getId());
	}
}
