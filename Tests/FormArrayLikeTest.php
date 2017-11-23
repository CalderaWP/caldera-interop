<?php

/**
 * Class FormArrayLikeTest
 *
 * @covers  \calderawp\interop\ArrayLike\Form
 */
class FormArrayLikeTest extends TestCase
{

    /**
     * Test form ID is accessible
     *
     * @covers  \calderawp\interop\ArrayLike\Form::__construct
     * @covers  \calderawp\interop\ArrayLike\ArrayLike::__construct
     * @covers  \calderawp\interop\ArrayLike\ArrayLike::offsetGet()
     */
    public function testFormId()
    {
        $formId = 'fld4231';
        $formConfig = $this->formArrayFactory( $formId );
        $this->assertSame( $formId, $formConfig[ 'ID' ] );

        $formArrayLike = new \calderawp\interop\ArrayLike\Form( $formConfig );

        $this->assertEquals( $formId, $formArrayLike[ 'ID' ] );
    }

    /**
     * Test form ID accessor works
     *
     * @covers  \calderawp\interop\ArrayLike\Form::getId()
     */
    public function testFormGetId()
    {

        $formId = 'fld4231';
        $formConfig = $this->formArrayFactory( $formId );

        $formArrayLike = new \calderawp\interop\ArrayLike\Form( $formConfig );

        $this->assertEquals( $formId, $formArrayLike->getId() );
    }


    /**
     * Test form ID setter works
     *
     * @covers  \calderawp\interop\ArrayLike\Form::getId()
     * @covers  \calderawp\interop\ArrayLike\Form::setId()
     */
    public function testFormSetId()
    {

        $formId = 'fld4231';
        $formConfig = $this->formArrayFactory( $formId );

        $formArrayLike = new \calderawp\interop\ArrayLike\Form( $formConfig );

        $this->assertEquals( $formId, $formArrayLike->getId() );

        $formArrayLike->setId( 'HiRoy' );

        $this->assertNotSame( $formId, $formArrayLike->getId() );
        $this->assertNotSame( $formId, $formArrayLike[ 'ID' ] );

        $this->assertEquals( 'HiRoy', $formArrayLike->getId() );
        $this->assertEquals( 'HiRoy', $formArrayLike[ 'ID' ] );

    }

}