<?php

/**
 * @covers \calderawp\interop\Collections\EntityCollections\Fields
 */
class FieldsEntityCollectionTest extends CollectionTestCase
{

	/**
	 * Test field set/get
     *
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::addField()
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::getField()
	 */
	public function testAdd()
	{
		$field8 = $this->entityFactory( 'FIELD', 'fld8' );
		$field4 = $this->entityFactory( 'FIELD', 'fld4' );
		$fields = new \calderawp\interop\Collections\EntityCollections\Fields();
		$fields
			->addField( $field4 )
			->addField( $field8 )
		;

		$this->assertSame( $field8, $fields->getField( 'fld8' ) );
		$this->assertSame( $field4, $fields->getField( 'fld4' ) );

	}

	/**
	 * Test field set/get with initial fields
	 *
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::addField()
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::getField()
	 */
	public function testGetField()
	{
		$extraFieldArray = $this->fieldArrayFactory( 400 );
		$extraField = new \calderawp\interop\Entities\Field(  $extraFieldArray );
		$fieldsEntityCollection = $this->fieldEntityCollection( [10,20] );
		$fieldsEntityCollection->addField( $extraField );
		$this->assertEquals( $extraField, $fieldsEntityCollection->getField( 400 ) );

		$field10 = $fieldsEntityCollection->getField( 10 );
		$this->assertEquals( 10,  $field10->getId() );
		$this->assertNotSame( $fieldsEntityCollection->getField( 10 ), $fieldsEntityCollection->getField( 400 ) );
	}

	/**
	 * Test that get field returns null for unknown field
	 *
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::addField()
	 */
	public function testGetNotSetField()
	{
		$fieldsEntityCollection = $this->fieldEntityCollection( [10,20] );

		$this->assertTrue( is_null( $fieldsEntityCollection->getField( 500 ) ) );

	}
	/**
	 * Test array conversion
	 *
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::addField()
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::toArray()
	 */
	public function testToArray()
	{
		$field8 = $this->entityFactory( 'FIELD', 8 );
		$field4 = $this->entityFactory( 'FIELD', 4 );
		$fields = new \calderawp\interop\Collections\EntityCollections\Fields();
		$fields
			->addField( $field4 )
			->addField( $field8 );

		$arrayed = $fields->toArray();
		$this->assertInternalType( 'array', $arrayed );


		$this->assertArrayHasKey( 4, $arrayed );
		$this->assertArrayHasKey( 8, $arrayed );

		$this->assertInternalType( 'array', $arrayed[4] );
		$this->assertInternalType( 'array', $arrayed[8] );

		$this->assertSame( $this->fieldArrayFactory( 4 ), $arrayed[4] );
		$this->assertSame( $this->fieldArrayFactory( 8 ), $arrayed[8] );

	}
}