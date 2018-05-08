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

	private $validated =  [];
	/** @inheritdoc */
	public function __set($name, $value)
	{
		if ('id' === $name) {
			$this->setId($value);
			return;
		}
		if (property_exists($this, $name)) {
			$this->$name = $this->dispatchCallbacks($name, $value);
		}
	}
	/** @inheritdoc */
	public function __get($name)
	{
		if ('id' === $name) {
			return $this->getId();
		}

		if (property_exists($this, $name)) {
			if ($this->shouldDispatch($name)) {
				$this->$name = $this->dispatchCallbacks($name, $this->$name);
			}
			return $this->$name;
			$this->validated[] = $name;
		}
	}


	/** @inheritdoc */
	public function toArray()
	{
		$array = Arr::except(parent::toArray(), 'casts');

		foreach ($this->getEntityProps() as $propName) {
			if ($this->shouldDispatch($propName)) {
				$array[$propName] = $this->dispatchCallbacks($propName, $array[$propName]);
			}
		}

		return $array;
	}
	
	private function shouldDispatch($propName)
	{
		return 'casts' !== $propName && ! in_array($propName, $this->validated);
	}

	private function dispatchCallbacks($propName, $value)
	{

		if ($this->hasCastCallback($propName)) {
			$value = $this->dispatchCast($propName, $value);
		}
		return $this->maybeValidateValue($propName, $value);
	}
}
