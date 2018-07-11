<?php


namespace calderawp\interop;
use calderawp\interop\Contracts\InteroperableAttribute;
use calderawp\interop\Traits\CanBeAcessedLikeAnArray;
use calderawp\interop\Traits\CanBecomeFromArray;
use calderawp\interop\Traits\HasId;


/**
 * Class Attribute
 *
 * Object abstration of an attribute of an entity
 */
class Attribute implements InteroperableAttribute, \ArrayAccess
{

    use CanBecomeFromArray, CanBeAcessedLikeAnArray;
    /**
     * The unique identifier for the attribute
     * @var string
     */
    protected $name;

    /**
     * Defautl value for attribute
     *
     * @var mixed
     */
    protected $default;
    /**
     * Sanization callback for attribute
     *
     * @var callable|null
     */
    protected $sanitize;
    /**
     * Validation callback for attribute
     *
     * @var callable|null
     */
    protected $validate;

    /**
     * @inheritDoc
     */
    public function __get($name)
    {
        if( property_exists( $this, $name )){
            return $this->offsetGet($name);
        }
    }


    /** @inheritdoc */
    public function toArray(){
        $array = [];
        foreach (array_keys(get_object_vars($this)) as $prop) {
            $array[ $prop ] = $this->__get($prop);
        }
        return $array;
    }

    public function __set($name, $value)
    {
        if( property_exists( $this, $name )){
            $this->$name = $value;
            $this->offsetSet($name, $value );

        }
        return $this;
    }

    /** @inheritdoc */
    public function jsonSerialize(){
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->offsetGet('name');
    }

    /**
     * @param string $name
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->offsetSet('name',$name);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->offsetGet('default');
    }

    /**
     * @param mixed $default
     * @return Attribute
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this->offsetSet('default', $default );

        return $this;
    }

    /**
     * @return callable|null
     */
    public function getSanitize()
    {
        return $this->offsetGet('sanitize');
    }

    /**
     * @param callable|null $sanitize
     * @return Attribute
     */
    public function setSanitize($sanitize)
    {
        $this->sanitize = $sanitize;
        $this->offsetSet('sanitize',$sanitize);
        return $this;
    }

    /**
     * @return callable|null
     */
    public function getValidate()
    {
        return $this->offsetGet('validate');
    }

    /**
     * @param callable|null $validate
     * @return Attribute
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
        $this->offsetSet('validate',$validate);
        return $this;
    }


}