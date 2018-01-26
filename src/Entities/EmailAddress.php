<?php


namespace calderawp\interop\Entities;

/**
 * Class EmailAddress
 *
 * Object representation of email with optional name. MUST be implimented in context -- Recipinet, Submitter, CC, BCC et.
 *
 * @package calderawp\interop\Entities
 */
abstract class EmailAddress extends Entity
{

    /**
     * The email's name
     *
     * @var string
     */
    protected $name;

    /**
     * The email's address
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