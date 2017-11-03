<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 10:41 PM
 */

namespace calderawp\interop\Entities;


use calderawp\interop\Container;
use calderawp\interop\Traits\HasId;

abstract class Entity
{
	use HasId;



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