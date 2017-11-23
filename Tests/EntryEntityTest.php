<?php

/**
 * Class EntryEntityTest
 *
 *= @covers  \calderawp\interop\Entities\Entry
 */
class EntryEntityTest extends EntityTestCase
{

    /**
     * Test getting entry details from entity
     *
     * @covers  \calderawp\interop\Entities\Entry\getEntryDetails()
     */
    public function testGetEntryDetails()
    {
        $details = $this->entityFactory( 'ENTRY_DETAILS', 40 );
        $entry = new \calderawp\interop\Entities\Entry(
            $details,
            new \calderawp\interop\Collections\EntityCollections\EntryValues\Fields(
                [
                    $this->entityFactory( 'ENTRY_VALUE', 40 ),
                    $this->entityFactory( 'ENTRY_VALUE', 41 ),
                    $this->entityFactory( 'ENTRY_VALUE', 42 )
                ]
            ),
           $this->entityFactory( 'FORM', 'CF12334' )
        );

        $this->assertEquals( $details, $entry->getEntryDetails() );

    }

    /**
     * Test getting field entry values from entity
     *
     * @covers  \calderawp\interop\Entities\Entry\getFieldValue()
     */
    public function testGetFieldValues()
    {

        $fieldOne = $this->entityFactory( 'ENTRY_VALUE', 'fld1' );
        $fieldTwo = $this->entityFactory( 'ENTRY_VALUE', 'fld2' );

        $entry = new \calderawp\interop\Entities\Entry(
            $this->entityFactory( 'ENTRY_DETAILS', 40 ),
            new \calderawp\interop\Collections\EntityCollections\EntryValues\Fields(
                [
                    $fieldOne,
                    $fieldTwo
                ]
            ),
            $this->entityFactory( 'FORM', 'CF12334' )
        );

        $this->assertEquals( $fieldOne, $entry->getFieldValue( 'fld1' ) );
        $this->assertEquals( $fieldTwo, $entry->getFieldValue( 'fld2' ) );

    }
}