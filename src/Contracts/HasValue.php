<?php


namespace calderawp\interop\Contracts;

interface HasValue
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
	 * @return HasValue
	 */
	public function setValue($value): HasValue;
	/**
	 * Set default
	 *
	 * @param string|int|array $default
	 *
	 * @return HasValue
	 */
	public function setDefault($default): HasValue;

	/**
	 * Get default
	 *
	 * @return array|int|string
	 */
	public function getDefault();
}
