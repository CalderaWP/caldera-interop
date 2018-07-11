<?php


namespace calderawp\interop;
use calderawp\interop\Contracts\InteroperableAttribute;


/**
 * Class Attribute
 *
 * Object abstration of an attribute of an entity
 */
class Attribute implements InteroperableAttribute
{

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     * @return Attribute
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return callable|null
     */
    public function getSanitize()
    {
        return $this->sanitize;
    }

    /**
     * @param callable|null $sanitize
     * @return Attribute
     */
    public function setSanitize($sanitize)
    {
        $this->sanitize = $sanitize;
        return $this;
    }

    /**
     * @return callable|null
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * @param callable|null $validate
     * @return Attribute
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
        return $this;
    }


}