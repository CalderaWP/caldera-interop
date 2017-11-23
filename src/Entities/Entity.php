<?php

namespace calderawp\interop\Entities;


use calderawp\interop\Interfaces\JsonArrayable;
use calderawp\interop\Traits\HasId;

abstract class Entity implements JsonArrayable
{
	use HasId;

    /**
     * Create from array
     *
     * @param array $items
     * @return static
     */
	public static function fromArray( array  $items )
    {
        $obj = new static();
        foreach ( $items as $key => $item ){
            $obj->$key = $item;
        }

        return $obj;
    }


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

    /** @inheritdoc */
	public function toArray()
    {
        return  get_object_vars( $this );
    }

}