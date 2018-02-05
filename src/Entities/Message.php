<?php


namespace calderawp\interop\Entities;


use calderawp\interop\Traits\CanCastEmail;
use calderawp\interop\Traits\CanCastProps;

/**
 * Class Message
 *
 * Object-representation of a message, in the format of a CF Pro message
 *
 * NOTE: This doesn't have all properties the Laravel model supports. Only props needed by anti-spam are currently implemented.
 *
 * @package calderawp\interop\Entities
 */
class Message extends Entity
{


    use CanCastEmail, CanCastProps;

    /**
     * @var EmailRecipient
     */
    protected $to;

    /**
     * @var EmailSender
     */
    protected $from;

    /**
     * @var EmailReplyTo
     */
    protected $replyto;

    /**
     * @var EmailRecipient
     */
    protected $cc;

    /**
     * @var EmailRecipient
     */
    protected $bcc;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $subject;

    protected $casts = [
        'to' => 'EmailRecipient',
        'cc' => 'EmailRecipient',
        'bcc' => 'EmailRecipient',
        'from' => 'EmailSender',
        'replyto' => 'EmailReplyTo',
        'subject' => 'string',
        'content' => 'string'
    ];

}