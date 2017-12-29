<?php


class CastingEntityTest extends EntityCalderaInteropTestCase
{

    /**
     *
     * @covers CanCastProps::__set()
     * @covers CanCastProps::hasCast()
     * @covers CanCastProps::applyCast()
     * @covers CanCastProps::castCallback()
     * @covers CanCastProps::castArray()
     */
    public function testValidCastArray()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->hi = [ 'hi' => 'Mike' ];

        $this->assertTrue( is_array( $entity->hi ), json_encode( $entity->hi ) );
        $this->assertArrayHasKey( 'hi', $entity->hi );
        $this->assertEquals( 'Mike', $entity->hi[ 'hi'] );


    }


    /**
     *
     * @covers CanCastObjectToArray::maybeCastObject()
     * @covers CanCastProps::maybeCastObject()
     */
    public function testValidCastArrayFromObject()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->hi = (object)[ 'hi' => 'Mike' ];

        $this->assertTrue( is_array( $entity->hi ), json_encode( $entity->hi ) );
        $this->assertArrayHasKey( 'hi', $entity->hi );
        $this->assertEquals( 'Mike', $entity->hi[ 'hi'] );


    }

    /**
     *
     * @covers CanCastProps::__set()
     * @covers CanCastProps::hasCast()
     * @covers CanCastProps::applyCast()
     * @covers CanCastProps::castCallback()
     * @covers CanCastProps::castArray()
     */
    public function testInvalidCastArray()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->hi = 'nom';

        $this->assertTrue( is_array( $entity->hi ) );
        $this->assertEmpty( $entity->hi );

    }

    /**
     *
     * @covers CanCastProps::__set()
     * @covers CanCastProps::hasCast()
     * @covers CanCastProps::applyCast()
     * @covers CanCastProps::castCallback()
     * @covers CanCastProps::castArray()
     */
    public function testValidCastString()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->title =  'Mike';

        $this->assertTrue( is_string( $entity->title ), json_encode( $entity->title ) );
        $this->assertEquals( 'Mike', $entity->title );


    }

    /**
     *
     * @covers CanCastProps::__set()
     * @covers CanCastProps::hasCast()
     * @covers CanCastProps::applyCast()
     * @covers CanCastProps::castCallback()
     * @covers CanCastProps::castArray()
     */
    public function testInvalidCastString()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->title = [ 'hi' => 'Mike' ];

        $this->assertTrue( is_string( $entity->title ), gettype($entity->title ) );
        $this->assertEmpty( $entity->title );

    }

    /**
     * Ensure that invalid props don't still work
     *
     * @covers CanCastProps::__get()
     * @covers CanCastProps::__set()
     */
    public function testInvalidProp()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->a = 1;
        $this->assertEmpty( $entity->a );
    }

    /**
     * Test an  integer is NOT effected by castNumeric
     *
     * @covers CanCastProps::castNumeric()
     */
    public function testCastNumericInteger()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->xp = 42;
        $this->assertEquals( 42, $entity->xp );
    }


    /**
     * Test a numeric string is cast to an integer by castNumeric
     *
     * @covers CanCastProps::castNumeric()
     */
    public function testCastNumericString()
    {
        $entity = new \calderawp\interop\Mock\CastingEntity();
        $entity->xp = '42';
        $this->assertTrue(is_integer( $entity->xp ) );
        $this->assertEquals( 42, $entity->xp );
    }

}