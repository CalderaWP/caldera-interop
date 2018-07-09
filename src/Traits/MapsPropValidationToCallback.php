<?php


namespace calderawp\interop\Traits;

/**
 * Trait MapsPropValidationToCallback
 *
 * Used to share validation dispatch logic between CanValidatePropertySet and CanCastAndValidateProps
 */
trait MapsPropValidationToCallback
{


	/**
	 * Validate prop, if validator exists
	 *
	 * @param string $propName Name of prop
	 * @param mixed $value New value
	 * @return mixed
	 */
	protected function maybeValidateValue($propName, $value)
	{
		$validationCb = $this->getValidationCallbackName($propName);
		if ($this->hasValidationCallback($propName)) {
			$value = call_user_func([ $this, $validationCb ], $value);
		}

		return $value;
	}


	protected function hasValidationCallback($name)
	{
		$validationCb = $this->getValidationCallbackName($name);
		if (is_callable([ $this, $validationCb ])) {
			return true;
		}
		return false;
	}

	/**
	 * Get name of validation callback
	 *
	 * @param string $propName Property name
	 * @return string Name of callback function
	 */
	protected function getValidationCallbackName($propName)
	{
		$validationCb = 'validate' . ucfirst($propName);
		return $validationCb;
	}
}
