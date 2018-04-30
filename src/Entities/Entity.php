<?php

namespace calderawp\interop\Entities;

use calderawp\interop\Interfaces\InteroperableEntity;
use calderawp\interop\Interfaces\JsonArrayable;
use calderawp\interop\Traits\CanHttp;
use calderawp\interop\Traits\HasId;

abstract class Entity implements JsonArrayable, InteroperableEntity
{
	use HasId, CanHttp;

	/**
	 * Create from array
	 *
	 * @param  array $items
	 * @return static
	 */
	public static function fromArray(array  $items)
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
		if (property_exists($this, $name)) {
			$this->$name = $value;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __get($name)
	{

		if (property_exists($this, $name)) {
			return $this->$name;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __isset($name)
	{
		return property_exists($this, $name) && ! empty($this->$name);
	}

	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		return  get_object_vars($this);
	}

	/**
	 * @return array
	 */
	public function getEntityProps()
	{
		return array_keys(get_object_vars($this));
	}

	/**
	 * Get the type of entity
	 *
	 * @return string
	 */
	public function getTheType()
	{
		return strtolower(substr(strrchr(get_class($this), '\\'), 1));
	}

}
