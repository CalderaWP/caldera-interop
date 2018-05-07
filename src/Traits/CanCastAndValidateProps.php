<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Support\Arr;

/**
 * Trait CanCastAndValidateProps
 * @package calderawp\interop\Traits
 */
trait CanCastAndValidateProps
{
	use  MapsPropValidationToCallback, MapsCastsToCallback;

	/**
	 * @inheritdoc
	 */
	public function __set($name, $value)
	{
		if (! property_exists($this, $name)) {
			$this->$name = $value;
		}else{
			$this->applyCast($name, $value);
			$this->$name = $this->maybeValidateValue($name,$this->$name);
		}

	}

	/** @inheritdoc */
	public function toArray()
	{
		return Arr::except(parent::toArray(), 'casts');
	}
}
