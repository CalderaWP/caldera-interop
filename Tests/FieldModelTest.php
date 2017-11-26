<?php


/**
 * Class Field
 *
 * @covers  \calderawp\interop\Models\Field
 */

use calderawp\interop\Models\Field as FieldModel;

/**
 * Class FieldTest
 *
 * @covers \calderawp\interop\Models\Field
 */
class FieldModelTest extends ModelCalderaInteropTestCase
{
	/**
	 * Test ID set of this model
	 *
	 * @covers \calderawp\interop\Models\Field::getId()
	 * @covers \calderawp\interop\Models\Field::setId()
	 */
	public function testIdSet()
	{
		$entity = $this->entityFactory( 'field', 42 );
		$field = new FieldModel( $entity ) ;
		$field->setId(42);
		$this->assertEquals(42, $field->getId());

	}

	/**
	 * Test that ID is set properly when using fromArray() factory
	 *
	 * @covers \calderawp\interop\Models\Field::getId()
	 * @covers \calderawp\interop\Models\Field::fromArray()
	 */
	public function testIdSetFromArray(){
		$field = FieldModel::fromArray( array( 'ID' => 42 ) );
		$this->assertEquals( 42, $field->getId() );
	}



	/**
	 * Test that if created using using fromArray() factory we can manipulate ID properly
	 *
	 * @covers \calderawp\interop\Models\Field::getId()
	 * @covers \calderawp\interop\Models\Field::setId()
	 * @covers \calderawp\interop\Models\Field::fromArray()
	 * @covers \calderawp\interop\Models\Model::fixId()
	 */
	public function testIdChangeSetFromArray(){
		$field = FieldModel::fromArray( array( 'ID' => 42 ) );
		$this->assertEquals( 42, $field->getId() );
		$field->setId( 21 );
		$this->assertEquals( 21, $field->getId() );
	}



}