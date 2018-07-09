<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\InteroperableEntity;
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

	/**
	 * @inheritdoc
	 */
	public function __set($name, $value)
	{
		if ($this->hasSetter($name)) {
			return $this->applySetter($name, $value);
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
			$array[ $prop ] = $this->__get($prop);
		}
		return $array;
	}

	/**
	 * @return array
	 */
	public function getEntityProps()
	{
		return array_keys(get_object_vars($this));
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
}
