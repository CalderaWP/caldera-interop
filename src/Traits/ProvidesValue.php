<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\InteroperableEntityContract;

trait ProvidesValue
{
	/**
	 * @var string|int|array
	 */
	protected $value;
	/**
	 * @var string|int|array
	 */
	protected $default;

	/**
	 * Get value
	 *
	 * @return array|int|string
	 */
	public function getValue()
	{
		return null !== $this->value ? $this->value : $this->getDefault();
	}

	/**
	 * Set value
	 *
	 * @param string|int|array $value
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Set default
	 *
	 * @param string|int|array $default
	 *
	 * @return InteroperableEntityContract
	 */
	public function setDefault($default) : InteroperableEntityContract
	{
		$this->default = $default;
		return $this;
	}

	/**
	 * Get default
	 *
	 * @return array|int|string
	 */
	public function getDefault()
	{
		return $this->default;
	}
}
