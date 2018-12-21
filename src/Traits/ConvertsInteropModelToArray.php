<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\Interoperable;

trait ConvertsInteropModelToArray
{

	/**
	 * Convert Interoperable Model to an array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		$array = [];
		foreach (get_object_vars($this) as $prop => $value) {
			$array[$prop] = $this->$prop;
		}

		return $array;
	}

	/** @inheritdoc */
	public function __get($name)
	{
		if (is_callable([$this,$this->getGetterName($name)])) {
			return call_user_func([$this,$this->getGetterName($name)]);
		}
	}

	/**
	 * Get the name of the expected getter
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function getGetterName(string $name):string
	{
		return  'get' . ucfirst(strtolower($name));
	}
}
