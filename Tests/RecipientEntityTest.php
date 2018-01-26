<?php

use \calderawp\interop\Entities\Recipient;

class RecipientEntityTest extends EntityCalderaInteropTestCase
{

    /**
     * Test get and set name
     *
     * @covers Recipient::$name
     * @covers Recipient::__get()
     * @covers Recipient::__set()
     */
    public function testSetName()
    {
        $entity = new Recipient();
        $entity->name = 'Batman';
        $this->assertSame( 'Batman', $entity->name );
    }

    /**
     * Test get and set email
     *
     * @covers Recipient::$email
     * @covers Recipient::__get()
     * @covers Recipient::__set()
     */
    public function testSetEmail()
    {
        $entity = new Recipient();
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }

    /**
     * Test get and set email together
     *
     * @covers Recipient::$name
     * @covers Recipient::$email
     * @covers Recipient::__get()
     * @covers Recipient::__set()
     */
    public function testSetNameEmail()
    {
        $entity = new Recipient();
        $entity->email = 'batman@isotrope.net';
        $entity->name = 'Batman';
        $this->assertSame( 'Batman', $entity->name );
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }

    /**
     * Test conversion to array
     *
     * @covers Recipient::toArray()
     */
    public function testToArray()
    {
        $entity = new Recipient();
        $entity->email = 'batman@isotrope.net';
        $entity->name = 'Batman';
        $array = $entity->toArray();
        $this->assertSame( 'Batman', $array[ 'name' ] );
        $this->assertSame( 'batman@isotrope.net', $array[ 'email' ] );

    }

    /**
     * Test conversion to array
     *
     * @covers Recipient::fromArray()
     */
    public function testFromArray()
    {
        $entity = Recipient::fromArray( array(
            'name' => 'Batman',
            'email' => 'batman@isotrope.net'
        ));

        $array = $entity->toArray();
        $this->assertSame( 'Batman', $array[ 'name' ] );
        $this->assertSame( 'batman@isotrope.net', $array[ 'email' ] );
    }

    /**
     * Test conversion to string when only an email is present
     *
     * @covers Recipient::__toString()
     */
    public function testToStringWithoutName()
    {
        $entity = new Recipient();
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'batman@isotrope.net', $entity->__toString() );
    }

    /**
     * Test conversion to string
     *
     * @covers Recipient::__toString()
     */
    public function testToStringWithName()
    {
        $entity = new Recipient();
        $entity->name = 'Batman';
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'Batman <batman@isotrope.net>', $entity->__toString() );
    }


}