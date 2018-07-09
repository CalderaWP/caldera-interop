<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\InteroperableEntity;
use calderawp\interop\Exceptions\Exception;
use calderawp\interop\Exceptions\NotImplemented;
use calderawp\interop\Traits\HasId;

/**
 * Class Entity
 *
 * Base entity so that in most cases, entities just have to define fields.
 */
abstract class Entity implements InteroperableEntity
{

	use HasId;

    /**
     * @var array
     */
	protected $attributes;

    /**
     * @var array
     */
	protected $values;

	/**
	 * Create from array
	 *
	 * @param  array $items
	 * @return static
	 */
	public static function fromArray(array $items)
	{
		$obj = new static($items);
		foreach ($items as $key => $item) {
			$obj->__set($key, $item);
		}
		return $obj;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}


    protected function setAttributes(array $attributes = [] ){
        if (! empty( $attributes)) {
            foreach ($attributes as $attributeId => $attribute) {
                $this->attributes[$attributeId] = $attribute;
                $this->attributes[$attributeId]['ID'] = $attributeId;
                $this->values[$attributeId] = $attribute['default'];
            }
        }
    }

    /**
	 * @inheritdoc
	 */
	public function __set($name, $value)
	{

		if ($this->hasSetter($name)) {
			return $this->applySetter($name, $value);
		}
        if( $this->hasPropDefinition($name ) ){
            return $this->setProp($name,$value);
        }
		if (property_exists($this, $name)) {
			$this->$name = $value;
			return $this;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __get($name)
	{

		if ($this->hasGetter($name)) {
			return $this->applyGetter($name);
		}
        if( $this->hasPropDefinition($name ) ){
            return $this->getProp($name);
        }
		if (property_exists($this, $name)) {
			return $this->$name;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __isset($name)
	{
		return property_exists($this, $name) && !empty($this->$name);
	}

	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		$array = [];
		foreach ($this->getEntityProps() as $prop) {
		    if( in_array( $prop, [ 'values', 'attributes' ] ) ){
		        continue;
            }
			$array[ $prop ] = $this->__get($prop);
		}
		return $array;
	}

	/**
	 * @return array
	 */
	public function getEntityProps()
	{
		return array_merge(
		    array_keys(get_object_vars($this)),
            array_keys($this->attributes )
        );
	}

	/**
	 * @param string $prop
	 * @return string
	 */
	private function getterName($prop)
	{
		return 'get' . ucfirst($prop);
	}

	/**
	 * @param string $prop
	 * @return string
	 */
	private function setterName($prop)
	{
		return 'set' . ucfirst($prop);
	}

	/**
	 * Get a value for a property using the getter function
	 *
	 * @param string $prop The name of the property to call the getter function of.
	 * @return mixed
	 * @throws NotImplemented
	 */
	public function applyGetter($prop)
	{
		$callable = [ $this, $this->getterName($prop)];
		if (! is_callable($callable)) {
			throw new NotImplemented(json_encode($callable));
		}
		return call_user_func($callable);
	}

	/**
	 * Set a value for a property using its setter
	 *
	 * @param string $prop The property to call the setter function for.
	 * @param mixed $value Value to set for the propety.
	 * @return $this
	 * @throws NotImplemented
	 */
	public function applySetter($prop, $value)
	{
		$callable = [ $this, $this->setterName($prop)];
		if (! is_callable($callable)) {
			throw new NotImplemented(json_encode($callable));
		}
		return call_user_func($callable, $value);
	}

	/**
	 * @param string $prop
	 * @return bool
	 */
	public function hasGetter($prop)
	{
		return method_exists($this, $this->getterName($prop));
	}

	/**
	 * @param string $prop
	 * @return bool
	 */
	public function hasSetter($prop)
	{
		return method_exists($this, $this->setterName($prop));
	}

    /**
     * @param string $prop The name of the property to check for
     * @return bool
     */
	public function hasProp($prop)
    {
        return (
            property_exists($this, $prop)
            || $this->hasGetter($prop)
            ||  $this->hasPropDefinition($prop)
        );
    }

    /**
     * @param string $prop The name of the property to get the definition of
     * @return bool
     */
    protected function hasPropDefinition($prop){
	    return array_key_exists( $prop, $this->attributes );
    }

    /**
     * @param string $prop The name of the property to get the definition of
     * @return array
     */
    protected function getPropDefinition($prop){
	    return $this->hasPropDefinition($prop) ? $this->attributes[$prop] : [];
    }

    /**
     * Get the value of a prop defined in attributes
     *
     * @param string $prop The name of the property to get the value of
     * @return mixed|null
     */
    public function getProp($prop){
	    if( ! $this->hasPropDefinition($prop) ){
	        return null;
        }
        return $this->values[$prop];
    }

    /**
     * Set a the value of a prop defined in attributes
     *
     * @param string $prop The name of the property to set the value of
     * @param mixed $value Value to set
     * @return $this
     */
    public function setProp($prop,$value){
        if( ! $this->hasPropDefinition($prop) ){
           return $this;
        }
        $this->values[$prop] = $value;
        return $this;
    }


    /**
     * Apply sanitation to a property
     *
     * @param array $prop The prop/attribute definition
     * @param mixed $value Value to set
     * @return $this
     */
    protected function sanitizePropValue(array$prop,$value){
	    if( is_callable( $prop['sanitize'] ) ){
	        return call_user_func( $prop['sanitize'],$value);
        }
        return $value;
    }

    /**
     * Check if prop value is valid
     *
     * @param array $prop The prop/attribute definition
     * @param mixed $value Value to set
     * @return bool
     */
    protected function validatePropValue(array $prop,$value){
        if( is_callable( $prop['validate'] ) ){
            return call_user_func( $prop['validate'],$value);
        }
        return true;
    }


}
