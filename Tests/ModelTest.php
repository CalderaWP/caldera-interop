<?php

class ModelTest extends ModelCalderaInteropTestCase
{

	/**
	 * Test set then get of model id
	 *
	 * @covers \calderawp\interop\Models\Model::getId()
	 * @covers \calderawp\interop\Models\Model::setId()
	 */
	public function testIdSet()
	{
		$model = new class( $this->entityFactory( 'Generic' ) ) extends  \calderawp\interop\Models\Model {};
		$model->setId(42);
		$this->assertEquals(42, $model->getId());
		$this->assertEquals( $model->getId(), $model->toEntity()->getId() );
	}

	/**
	 * Test get entity from model
	 *
	 * @covers  \calderawp\interop\Models\Model::toEntity();
	 */
	public function testToEntity()
	{
		$entity = $this->entityFactory( 'Generic' );
		$model = new class(  $entity ) extends  \calderawp\interop\Models\Model {};
		$this->assertEquals( $entity , $model->toEntity() );

	}
}