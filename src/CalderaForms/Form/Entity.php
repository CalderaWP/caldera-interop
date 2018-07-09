<?php


namespace calderawp\interop\CalderaForms\Form;


class Entity extends \calderawp\interop\Entity
{

    protected $name;
    protected $fields;


    public function getName()
    {
        return is_string($this->name ) ? $this->name : $this->getId();
    }

    public function getFields()
    {
        return is_array($this->fields) ? $this->fields : [];
    }

    public function setName($name)
    {
        if( is_string( $name  ) ){
            $this->name = $name;
        }

        return $this;
    }

    public function setFields(array  $fields )
    {
        if( is_array($fields )){
            $this->fields = $fields;
        }

        return $this;
    }
}