<?php


class EntryFieldValueEntityTest extends TestCase
{

    /**
     * Test create entity and get values
     *
     * @covers  \calderawp\interop\Entities\Entry\Field::fromArray()
     * @covers  \calderawp\interop\Entities\Entry\Field::toArray()
     */
    public function testSet()
    {
        $array = [
            'entry_id' => 42,
            'field_id' => 'fld1234',
            'slug' => 'pupper',
            'value' => 'is Awesome'
        ];
        $field = \calderawp\interop\Entities\Entry\Field::fromArray($array);
        $fieldToArray = $field->toArray();
        foreach ( $array as $k => $v ){
            $this->assertEquals( $v, $field->$k );
            $this->assertArrayHasKey( $k, $fieldToArray );
            $this->assertEquals( $v, $fieldToArray[ $k ] );
        }
    }

    /**
     * Test entity factory works with ENTRY_FIELD
     *
     * @covers  TestCase::entityFactory
     */
    public function testFromFactory()
    {
        $id = rand();
        $details = $this->entityFactory( 'ENTRY_VALUE', $id);
        $this->assertEquals( $id, $details->getId() );
        $detailsToArray = $details->toArray();
        foreach ( $detailsToArray as $k => $v ) {
            $this->assertEquals( $v, $details->$k );
            $this->assertArrayHasKey( $k, $detailsToArray );
            $this->assertEquals( $v, $detailsToArray[ $k ] );

        }
    }

}