<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Attribute;

class AttributeTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @covers \calderawp\interop\Attribute::getName()
     */
    public function testGetName()
    {
        $attribute = new Attribute();
        $attribute->setName('Roy');
        $this->assertSame( 'Roy', $attribute->getName() );
    }

    /**
     *
     * @covers \calderawp\interop\Attribute::setName()
     * @covers \calderawp\interop\Attribute::getName()
     */
    public function testSetName()
    {
        $attribute = new Attribute();
        $attribute->setName('Roy');
        $this->assertAttributeEquals('Roy', 'name', $attribute );
    }

    /**
     * @covers \calderawp\interop\Attribute::getValidate()
     */
    public function testGetValidate()
    {
        $attribute = new Attribute();
        $attribute->setValidate('cb');
        $this->assertSame( 'cb', $attribute->getValidate() );
    }

    /**
     * @covers \calderawp\interop\Attribute::setValidate()
     */
    public function testSetValidate()
    {
        $attribute = new Attribute();
        $attribute->setValidate('v_cb');
        $this->assertAttributeEquals('v_cb', 'validate', $attribute );
    }

    /**
     * @covers \calderawp\interop\Attribute::getDefault()
     */
    public function testGetDefault()
    {
        $attribute = new Attribute();
        $attribute->setDefault('Hi Roy');
        $this->assertSame( 'Hi Roy', $attribute->getDefault() );
    }


    /**
     * @covers \calderawp\interop\Attribute::getSanitize()
     */
    public function testGetSanitize()
    {
        $attribute = new Attribute();
        $attribute->setSanitize('cb');
        $this->assertSame( 'cb', $attribute->getSanitize() );
    }

    /**
     * @covers \calderawp\interop\Attribute::setSanitize()
     */
    public function testSetSanitize()
    {
        $attribute = new Attribute();
        $attribute->setSanitize('s_cb');
        $this->assertAttributeEquals('s_cb', 'sanitize', $attribute );
    }

    /**
     * @covers \calderawp\interop\Attribute::setDefault()
     */
    public function testSetDefault()
    {
        $attribute = new Attribute();
        $attribute->setDefault([]);
        $this->assertAttributeEquals([], 'default', $attribute );
    }
}
