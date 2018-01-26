<?php


namespace calderawp\interop\Entities;

/**
 * Class Recipient
 *
 * Object representation of email recipient
 *
 * @package calderawp\interop\Entities
 */
class Recipient extends Entity
{

    /**
     * The recipient's name
     *
     * @var string
     */
    protected $name;

    /**
     * The recipient's email
     *
     * @var string
     */
    protected $email;

    /** @inheritdoc */
    public function __toString()
    {
        if( empty( $this->name ) ){
            return $this->email;
        }

        return $this->name . ' <' . $this->email . '>';
    }

}