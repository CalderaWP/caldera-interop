<?php


namespace calderawp\interop\Traits;

/**
 *  Trait to allow entities or anything really to have validation callbacks when setting values.
 *
 *  Result of validation callback is used to set prop. Can be used ot sanitize or otherwise prepare value.
 *
 *  Callback function is named validate{ucfirst($prop)} IE for property $data, add a protected method called validateData
 */
trait CanValidatePropertySet
{

	use  CanCastObjectToArray, MapsPropValidationToCallback;

	/**
	 * @inheritdoc
	 */
	public function __set($name, $value)
	{
		if (property_exists($this, $name)) {
			$value = $this->maybeValidateValue($name, $value);
		}

		$this->$name = $value;
	}
}
