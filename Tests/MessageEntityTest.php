<?php


class MessageEntityTest extends EntityCalderaInteropTestCase
{


    /**
     * Test setting replyto
     *
     * @group message
     * @group email
     * @group casts
     *
     * @covers Message::$replyto
     * @covers CanCastEmail::castEmailReplyTo()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testReplyTo()
    {
        $email = 'mike@industry.io';
        $entity = new \calderawp\interop\Entities\Message();
        $entity->replyto = $email;
        $this->assertFalse( is_string( $entity->replyto ) );
        $this->assertTrue( is_object( $entity->replyto ) );
        $this->assertSame( \calderawp\interop\Entities\EmailReplyTo::class, get_class( $entity->replyto ) );
        $this->assertSame( $email,  $entity->replyto->email );

    }

    /**
     * Test setting to property
     *
     * @group message
     * @group email
     * @group casts
     *
     * @covers Message::$replyto
     * @covers CanCastEmail::castEmailSender()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testEmailSender()
    {
        $email = 'mike@industry.io';
        $entity = new \calderawp\interop\Entities\Message();
        $entity->from = $email;

        $this->assertFalse( is_string( $entity->from ) );
        $this->assertTrue( is_object( $entity->from ) );
        $this->assertSame( \calderawp\interop\Entities\EmailSender::class, get_class( $entity->from ) );
        $this->assertSame( $email,  $entity->from->email );

    }

    /**
     * Test setting cc property
     *
     * @group message
     * @group email
     * @group casts
     *
     * @covers Message::$cc
     * @covers CanCastEmail::castEmailRecipient()
     * @covers CanCastEmail::emailCaster()
     * @covers CanCastProps::hasCast()
     */
    public function testCC()
    {
        $email = 'mike@industry.io';
        $entity = new \calderawp\interop\Entities\Message();
        $entity->cc = $email;

        $this->assertFalse( is_string( $entity->cc ) );
        $this->assertTrue( is_object( $entity->cc ) );
        $this->assertSame( \calderawp\interop\Entities\EmailRecipient::class, get_class( $entity->cc ) );
        $this->assertSame( $email,  $entity->cc->email );

    }

}