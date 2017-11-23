<?php


class EntryDetailsEntityTest extends EntityTestCase
{

    /**
     * Test create entity and get values
     *
     * @covers  \calderawp\interop\Entities\Entry\Details::fromArray()
     * @covers  \calderawp\interop\Entities\Entry\Details::toArray()
     */
    public function testFromArray()
    {
        $formId = 'CF123';
        $array = [
            'form_id' => $formId,
            'user_id' => 1,
            'datestamp' => '11:42:01',
            'status' => 'active'
        ];

        $details = \calderawp\interop\Entities\Entry\Details::fromArray($array);
        $detailsToArray = $details->toArray();
        foreach ($array as $k => $v ) {
            $this->assertEquals( $v, $details->$k );
            $this->assertArrayHasKey( $k, $detailsToArray );
            $this->assertEquals( $v, $detailsToArray[ $k ] );

        }

    }

    /**
     * Test entity factory works with ENTRY_DETAILS
     *
     * @covers  TestCase::entityFactory
     */
    public function testFromFactory()
    {
        $details = $this->entityFactory( 'ENTRY_DETAILS', 42);
        $this->assertEquals( 42, $details->getId() );
        $this->assertEquals( 'cf12345', $details->form_id );
        $detailsToArray = $details->toArray();
        foreach ( $detailsToArray as $k => $v ) {
            $this->assertEquals( $v, $details->$k );
            $this->assertArrayHasKey( $k, $detailsToArray );
            $this->assertEquals( $v, $detailsToArray[ $k ] );

        }
    }

}