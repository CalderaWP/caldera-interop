<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface InteroperableModel
 *
 * Interface that interoperable models MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface InteroperableModel extends Interoperable
{

	/**
	 * @return bool
	 */
	public function isValid();

	/**
	 * Get type of model
	 *
	 * @return string
	 */
	public static function getType();
}
