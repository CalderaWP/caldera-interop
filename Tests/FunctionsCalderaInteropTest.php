<?php

/**
 * Class FunctionsTest
 *
 * Tests for src/functions.php
 */
class FunctionsCalderaInteropTest extends CalderaInteropTestCase
{

    /**
     * Test getMeta() returns correct object
     *
     * @covers  \calderawp\interop\getMeta()
     */
    public function testGetMeta()
    {
        $meta = \calderawp\interop\getMeta();
        $this->assertTrue(
            is_object( $meta )
        );

        $this->assertObjectHasAttribute( 'version', $meta );
    }

    /**
     * Test getBasePath() returns correct path
     *
     * @covers  \calderawp\interop\getBasePath()
     */
    public function testGetBasePath(){
        $base = dirname( __FILE__, 2 );
        $this->assertSame( $base, \calderawp\interop\getBasePath() );
    }

    /**
     * @covers  \calderawp\interop\Interop()
     */
    public function testGetInterop()
    {
        $this->assertSame( \calderawp\interop\Interop()->basePath(), \calderawp\interop\getBasePath() );
        $this->assertSame( \calderawp\interop\Interop()->version(), \calderawp\interop\getMeta()->version );
    }

}