<?php

use \calderawp\interop\Entities\EmailSender;

class SenderEntityTest extends EntityCalderaInteropTestCase
{

    /**
     * Test get and set name
     *
     * @covers EmailSender::$name
     * @covers EmailSender::__get()
     * @covers EmailSender::__set()
     */
    public function testSetName()
    {
        $entity = new EmailSender();
        $entity->name = 'Batman';
        $this->assertSame( 'Batman', $entity->name );
    }

    /**
     * Test get and set email
     *
     * @covers EmailSender::$email
     * @covers EmailSender::__get()
     * @covers EmailSender::__set()
     */
    public function testSetEmail()
    {
        $entity = new EmailSender();
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }

    /**
     * Test get and set email together
     *
     * @covers EmailSender::$name
     * @covers EmailSender::$email
     * @covers EmailSender::__get()
     * @covers EmailSender::__set()
     */
    public function testSetNameEmail()
    {
        $entity = new EmailSender();
        $entity->email = 'batman@isotrope.net';
        $entity->name = 'Batman';
        $this->assertSame( 'Batman', $entity->name );
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }

    /**
     * Test conversion to array
     *
     * @covers EmailSender::toArray()
     */
    public function testToArray()
    {
        $entity = new EmailSender();
        $entity->email = 'batman@isotrope.net';
        $entity->name = 'Batman';
        $array = $entity->toArray();
        $this->assertSame( 'Batman', $array[ 'name' ] );
        $this->assertSame( 'batman@isotrope.net', $array[ 'email' ] );

    }

    /**
     * Test conversion to array
     *
     * @covers EmailSender::fromArray()
     */
    public function testFromArray()
    {
        $entity = EmailSender::fromArray( array(
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
     * @covers EmailSender::__toString()
     */
    public function testToStringWithoutName()
    {
        $entity = new EmailSender();
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'batman@isotrope.net', $entity->__toString() );
    }

    /**
     * Test conversion to string
     *
     * @covers EmailSender::__toString()
     */
    public function testToStringWithName()
    {
        $entity = new EmailSender();
        $entity->name = 'Batman';
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'Batman <batman@isotrope.net>', $entity->__toString() );
    }


}