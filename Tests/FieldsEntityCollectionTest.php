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
		$field8 = $this->entityFactory( 'Field', 8 );
		$field4 = $this->entityFactory( 'Field', 4 );
		$fields = new \calderawp\interop\Collections\EntityCollections\Fields();
		$fields
			->addField( $field4 )
			->addField( $field8 )
		;

		$this->assertSame( $field8, $fields->getField( 8 ) );
		$this->assertSame( $field8, $fields->getField( 4 ) );

	}

	/**
	 * Test array conversion
	 *
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::addField()
	 * @covers  \calderawp\interop\Collections\EntityCollections\Fields::toArray()
	 */
	public function testToArray()
	{
		$field8 = $this->entityFactory( 'Field', 8 );
		$field4 = $this->entityFactory( 'Field', 4 );
		$fields = new \calderawp\interop\Collections\EntityCollections\Fields();
		$fields
			->addField( $field4 )
			->addField( $field8 )
		;

		$arrayed = $fields->toArray();
		$this->assertInternalType( 'array', $arrayed );


		$this->assertArrayHasKey( 4, $arrayed );
		$this->assertArrayHasKey( 8, $arrayed );

		$this->assertInternalType( 'array', $arrayed[4] );
		$this->assertInternalType( 'array', $arrayed[8] );

		$this->assertSame( $field4, $arrayed[4] );
		$this->assertSame( $field8, $arrayed[8] );

	}
}