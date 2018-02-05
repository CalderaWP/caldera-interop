<?php

use \calderawp\interop\Entities\EmailRecipient;

/**
 * Class RecipientEntityTest
 */
class RecipientEntityTest extends EntityCalderaInteropTestCase
{

    /**
     * Test get and set name
     *
     * @covers EmailRecipient::$name
     * @covers EmailRecipient::__get()
     * @covers EmailRecipient::__set()
     */
    public function testSetName()
    {
        $entity = new EmailRecipient();
        $entity->name = 'Batman';
        $this->assertSame( 'Batman', $entity->name );
    }

    /**
     * Test get and set email
     *
     * @covers EmailRecipient::$email
     * @covers EmailRecipient::__get()
     * @covers EmailRecipient::__set()
     */
    public function testSetEmail()
    {
        $entity = new EmailRecipient();
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }


    /**
     * Test set email via setter
     *
     * @covers EmailAddress::$email
     * @covers EmailAddress::setEmail()
     */
    public function testSetEmailWithSetter()
    {
        $entity = new EmailRecipient();
        $entity->setEmail( 'batman@isotrope.net' );
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }

    /**
     * Test set email via setter
     *
     * @covers EmailAddress::$name
     * @covers EmailAddress::setName()
     */
    public function testSetNameWithSetter()
    {
        $entity = new EmailRecipient();
        $entity->setName( 'Bruce Wayne' );
        $this->assertSame( 'Bruce Wayne', $entity->name );

    }

    /**
     * Test get and set email together
     *
     * @covers EmailRecipient::$name
     * @covers EmailRecipient::$email
     * @covers EmailRecipient::__get()
     * @covers EmailRecipient::__set()
     */
    public function testSetNameEmail()
    {
        $entity = new EmailRecipient();
        $entity->email = 'batman@isotrope.net';
        $entity->name = 'Batman';
        $this->assertSame( 'Batman', $entity->name );
        $this->assertSame( 'batman@isotrope.net', $entity->email );

    }

    /**
     * Test conversion to array
     *
     * @covers EmailRecipient::toArray()
     */
    public function testToArray()
    {
        $entity = new EmailRecipient();
        $entity->email = 'batman@isotrope.net';
        $entity->name = 'Batman';
        $array = $entity->toArray();
        $this->assertSame( 'Batman', $array[ 'name' ] );
        $this->assertSame( 'batman@isotrope.net', $array[ 'email' ] );

    }

    /**
     * Test conversion to array
     *
     * @covers EmailRecipient::fromArray()
     */
    public function testFromArray()
    {
        $entity = EmailRecipient::fromArray( array(
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
     * @covers EmailRecipient::__toString()
     */
    public function testToStringWithoutName()
    {
        $entity = new EmailRecipient();
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'batman@isotrope.net', $entity->__toString() );
    }

    /**
     * Test conversion to string
     *
     * @covers EmailRecipient::__toString()
     */
    public function testToStringWithName()
    {
        $entity = new EmailRecipient();
        $entity->name = 'Batman';
        $entity->email = 'batman@isotrope.net';
        $this->assertSame( 'Batman <batman@isotrope.net>', $entity->__toString() );
    }


}