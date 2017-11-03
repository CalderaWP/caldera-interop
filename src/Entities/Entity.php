<?php

namespace calderawp\interop\Entities;


use calderawp\interop\Arrayable\JsonArrayable;
use calderawp\interop\Traits\HasId;

abstract class Entity implements JsonArrayable
{
	use HasId;

	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

	/** @inheritdoc */
	public function __set($name, $value)
	{
		if( property_exists( $this, $name ) ){
			$this->$name = $value;
		}

	}

	/** @inheritdoc */
	public function __get($name)
	{
		if( property_exists( $this, $name ) ){
			return $this->$name;
		}
	}

}