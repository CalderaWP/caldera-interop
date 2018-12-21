<?php


namespace calderawp\interop\Contracts;


interface InteroperableEntityContract
{
	/**
	 * Get value
	 *
	 * @return array|int|string
	 */
	public function getValue();

	/**
	 * Set value
	 *
	 * @param string|int|array $value
	 *
	 * @return $this
	 */
	public function setValue($value);
	/**
	 * Set default
	 *
	 * @param string|int|array $default
	 *
	 * @return InteroperableEntityContract
	 */
	public function setDefault($default): InteroperableEntityContract;

	/**
	 * Get default
	 *
	 * @return array|int|string
	 */
	public function getDefault();
}
