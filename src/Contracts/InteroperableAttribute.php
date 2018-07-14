<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Attribute;

interface InteroperableAttribute extends Interoperable
{

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @param string $name
	 * @return Attribute
	 */
	public function setName($name);

	/**
	 * @return mixed
	 */
	public function getDefault();

	/**
	 * @param mixed $default
	 * @return Attribute
	 */
	public function setDefault($default);

	/**
	 * @return callable|null
	 */
	public function getSanitize();

	/**
	 * @param callable|null $sanitize
	 * @return Attribute
	 */
	public function setSanitize($sanitize);

	/**
	 * @return callable|null
	 */
	public function getValidate();
	/**
	 * @param callable|null $validate
	 * @return Attribute
	 */
	public function setValidate($validate);
}
