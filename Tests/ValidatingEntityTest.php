<?php


class ValidatingEntityTest extends EntityCalderaInteropTestCase
{

    /**
     *
     * @covers CanValidatePropertySet::__set
     */
    public function testValidCast()
    {
        $entity = new \calderawp\interop\Mock\ValidatingEntity();
        $entity->data = [ 'hi' => 'Mike' ];

        $this->assertTrue( is_array( $entity->data ) );
        $this->assertArrayHasKey( 'hi', $entity->data );
        $this->assertEquals( 'Mike', $entity->data[ 'hi'] );
    }

    /**
     *
     * @covers CanValidatePropertySet::__set
     * @covers CanValidatePropertySet::maybeCastObject()
     */
    public function testValidCastFromObject()
    {
        $entity = new \calderawp\interop\Mock\ValidatingEntity();
        $entity->data = (object)[ 'hi' => 'Mike' ];

        $this->assertTrue( is_array( $entity->data ) );
        $this->assertArrayHasKey( 'hi', $entity->data );
        $this->assertEquals( 'Mike', $entity->data[ 'hi'], json_encode( $entity->data ) );
    }

}