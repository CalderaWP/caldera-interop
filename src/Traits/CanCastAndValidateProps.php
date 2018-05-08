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

	/**
	 * Check if we should dispatch callbacks when setting this property.
	 *
	 * @param $propName
	 * @return bool
	 */
	private function shouldDispatch($propName)
	{
		//@TODO improve this hack to prevent dispatching casts prop reads
		return 'casts' !== $propName &&
			//Would be in this array already if callbacks ran
			! in_array($propName, $this->validated);
	}

	/**
	 * Dispatch cast and validation callbacks
	 *
	 * @param string $propName
	 * @param mixed $value
	 * @return mixed Prepared value
	 */
	private function dispatchCallbacks($propName, $value)
	{
		//Prevent multiple dispatches
		$this->validated[] = $propName;

		if ($this->hasCastCallback($propName)) {
			$value = $this->dispatchCast($propName, $value);
		}
		return $this->maybeValidateValue($propName, $value);
	}
}
