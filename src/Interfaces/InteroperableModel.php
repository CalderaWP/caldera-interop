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
	 * Convert to entity
	 *
	 * @return InteroperableEntity
	 */
	public function toEntity();
}
