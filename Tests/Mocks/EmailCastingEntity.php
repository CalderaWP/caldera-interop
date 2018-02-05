<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Entities\EmailRecipient;
use calderawp\interop\Entities\EmailReplyTo;
use calderawp\interop\Entities\EmailSender;
use calderawp\interop\Traits\CanCastEmail;
use calderawp\interop\Traits\CanCastProps;

class EmailCastingEntity extends Entity
{

    use CanCastEmail, CanCastProps;

    /**
     * @var EmailRecipient
     */
    protected $to;

    /**
     * @var EmailReplyTo
     */
    protected $replyto;
    /**
     * @var EmailSender
     */
    protected $from;

    protected $casts = [
        'to' => 'EmailRecipient',
        'from' => 'EmailSender',
        'replyto' => 'EmailReplyTo'
    ];


}