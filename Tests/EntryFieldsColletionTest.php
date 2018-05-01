<?php


class EntryFieldsCollectionTest extends  CollectionCalderaInteropTestCase
{

    /**
     * Test add field
     *
     *
     * @covers \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::addField()
     * @covers \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::getField()
     * @covers \calderawp\interop\Collections\EntityCollections\EntityCollection::getEntity()
     * @covers \calderawp\interop\Collections\EntityCollections\EntityCollection::addEntity()
     */
    public function testAdd()
    {
        $fields = new \calderawp\interop\Collections\EntityCollections\EntryValues\Fields();

        $field8 = $this->entityFactory( 'ENTRY_VALUE', 8 );
        $field4 = $this->entityFactory( 'ENTRY_VALUE', 'fld4' );


        $fields->addField( $field4 );
        $fields->addField( $field8 );

        $this->assertTrue( $fields->hasField( 8 ) );
        $this->assertEquals( $field8, $fields->getField( 8 ) );

        $this->assertTrue( $fields->hasField( 'fld4' ) );
        $this->assertEquals( $field4, $fields->getField( 'fld4' ) );

        $this->assertNull( $fields->getField( 42 ) );



    }

    /**
     * Test check for has field
     *
     *
     * @covers \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::addField()
     * @covers \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::hasField()
     * @covers \calderawp\interop\Collections\EntityCollections\EntityCollection::has()
     */
    public function testHas()
    {
        $fields = new \calderawp\interop\Collections\EntityCollections\EntryValues\Fields();

        $field8 = $this->entityFactory( 'ENTRY_VALUE', 8 );
        $field4 = $this->entityFactory( 'ENTRY_VALUE', 'fld4' );


        $fields->addField( $field4 );
        $fields->addField( $field8 );



        $this->assertFalse( $fields->hasField( 42 ) );
        $this->assertFalse( $fields->has( 42 ) );

        $this->assertTrue( $fields->hasField( 8 ) );
		$this->assertTrue( $fields->has( 8 ) );


		$this->assertTrue( $fields->hasField( 'fld4' ) );
		$this->assertTrue( $fields->has( 'fld4' ) );
    }


}