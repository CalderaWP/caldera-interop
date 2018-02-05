<?php


namespace calderawp\interop\Entities;


class Message extends Entity
{

    /**
     * @inhertidoc
     */
    protected $fillable = [
        'account',
        'layout',
        'pdf',
        'pdf_layout',
        'to',
        'reply',
        'cc',
        'bcc',
        'content',
        'subject',
        'hash',
        'opened',
        'clicked',
        'spammed',
        'entry_data',
        'local_id',
        'attachments'
    ];

    /**
     * @var int
     */
    protected $account;

    /**
     * @var EmailRecipient
     */
    protected $to;

    /**
     * @var EmailReplyTo
     */
    protected $reply;

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

    /** @inheritdoc */
    public function __set($name, $value)
    {
       if( in_array( $name, [
           'to',
           'cc',
           'bcc',
       ])){
           if( is_a( $value, EmailRecipient::class)){
               $this->$name = $value;
           }elseif ( is_array( $value ) ){
               $this->$name = EmailRecipient::fromArray( $value );
           }elseif ( is_string( $value ) ){
               $this->$name = ( new EmailRecipient()  )->email = $value;
           }
       }elseif ( 'reply' === $name ){
           if( is_a( $value, EmailReplyTo::class)){
               $this->$name = $value;
           }elseif ( is_array( $value ) ){
               $this->$name = EmailReplyTo::fromArray( $value );
           }elseif ( is_string( $value ) ){
               $this->$name = ( new EmailReplyTo()  )->email = $value;
           }
       }else{
           parent::__set($name, $value );
       }
    }


}