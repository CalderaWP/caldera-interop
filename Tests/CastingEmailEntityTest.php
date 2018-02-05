<?php


class CastingEmailEntityTestEntityTest extends EntityCalderaInteropTestCase
{

    /**
     * Test string to EmailRecipient
     *
     * @group email
     * @group casts
     * 
     * @covers CanCastEmail::castEmailRecipient()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testValidFromString()
    {
        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $entity->to = 'hi@hiroy.club';

        $this->assertFalse( is_string( $entity->to ) );
        $this->assertTrue( is_object( $entity->to ) );
        $this->assertSame( \calderawp\interop\Entities\EmailRecipient::class, get_class( $entity->to ) );
        $this->assertSame( 'hi@hiroy.club',  $entity->to->email );



    }

    /**
     * Test array to EmailRecipient
     *
     * @group email
     * @group casts
     * 
     * @covers CanCastEmail::castEmailRecipient()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testValidFromArray()
    {
        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $entity->to = [ 'email' => 'hi@hiroy.club' ];

        $this->assertSame( \calderawp\interop\Entities\EmailRecipient::class, get_class( $entity->to ) );
        $this->assertSame( 'hi@hiroy.club',  $entity->to->email );

        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $entity->to = [ 'email' => 'hi@hiroy.club', 'name' => 'Roy 3. Sivan' ];


        $this->assertSame( \calderawp\interop\Entities\EmailRecipient::class, get_class( $entity->to ) );
        $this->assertSame( 'hi@hiroy.club',  $entity->to->email );
        $this->assertSame( 'Roy 3. Sivan',  $entity->to->name );

    }

    /**
     * Test correct entity, when provided, is used
     *
     * @group email
     * @group casts
     * 
     * @covers CanCastEmail::castEmailRecipient()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testValidFromEntity()
    {

        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $toEntity = new \calderawp\interop\Entities\EmailRecipient();
        $toEntity->setName( 'Roy 3. Sivan' );
        $toEntity->setEmail( 'hi@roysivan.com' );
        $entity->to = $toEntity;
        $this->assertEquals( $toEntity, $entity->to );
    }

    /**
     * Test EmailReplyTo cast
     *
     * @group email
     * @group casts
     * 
     * @covers CanCastEmail::castEmailReplyTo()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testReplyTo()
    {
        $email = 'mike@industry.io';
        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $entity->replyto = $email;
        $this->assertFalse( is_string( $entity->replyto ) );
        $this->assertTrue( is_object( $entity->replyto ) );
        $this->assertSame( \calderawp\interop\Entities\EmailReplyTo::class, get_class( $entity->replyto ) );
        $this->assertSame( $email,  $entity->replyto->email );

    }

    /**
     * Test EmailSender cast
     *
     * @group email
     * @group casts
     * 
     * @covers CanCastEmail::castEmailSender()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testEmailSender()
    {
        $email = 'mike@industry.io';
        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $entity->from = $email;

        $this->assertFalse( is_string( $entity->from ) );
        $this->assertTrue( is_object( $entity->from ) );
        $this->assertSame( \calderawp\interop\Entities\EmailSender::class, get_class( $entity->from ) );
        $this->assertSame( $email,  $entity->from->email );

    }

    /**
     * Test that a non-email string causes an Exception to be thrown
     *
     * @group email
     * @group casts
     * 
     * @covers CanCastEmail::emailCaster()
     */
    public function testInvalidEmail()
    {
        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $this->setExpectedException(\calderawp\interop\Exceptions\Exception::class);
        $entity->replyto = 'Not an email';

        $entity = new \calderawp\interop\Mock\EmailCastingEntity();
        $this->setExpectedException(\calderawp\interop\Exceptions\Exception::class);
        $entity->replyto = [ 'email' => 'Not an email' ];

    }
}