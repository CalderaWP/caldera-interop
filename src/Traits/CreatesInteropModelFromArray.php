<?php


namespace calderawp\interop\Traits;
use calderawp\interop\Contracts\Interoperable;

/**
 * Trait CreatesInteropModelFromArray
 *
 * A static method for creating from an array expecting the array to have keys that match object's properties
 */
trait CreatesInteropModelFromArray
{
	/**
	 * Create from array
	 *
	 * @param  array $items
	 * @return static
	 */
	public static function fromArray(array $items) : Interoperable
	{
		$obj = new static($items);
		foreach ($items as $key => $item) {
			$obj->__set($key, $item);
		}
		return $obj;
	}

	/** @inheritdoc */
	public function __set($name, $value)
	{
		if( is_callable([$this,$this->getSetterName($name)])){
			call_user_func([$this,$this->getSetterName($name)],$value);
			return $this;
		}

		if( property_exists($this, $name ) ){
			$this->$name = $value;
		}

		return $this;
	}

	/**
	 * Get the name of the expected setter
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function getSetterName(string $name) : string
	{
		return  'set' . ucfirst(strtolower($name));

	}
}
