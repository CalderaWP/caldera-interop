<?php


namespace calderawp\interop\Traits;

/**
 * Trait CanCastProps
 *
 * Trait that casts values when set on entity.
 */
trait CanCastProps
{
	use  MapsCastsToCallback;

	/**
	 * @inheritdoc
	 */
	public function __set($name, $value)
	{
		if (property_exists($this, $name)) {
			if ($this->hasCast($name)) {
				$this->applyCast($name, $value);
			} else {
				$this->$name = $value;
			}
		}
	}




}
