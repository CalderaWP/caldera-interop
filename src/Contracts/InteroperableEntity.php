<?php


namespace calderawp\interop\Contracts;

/**
 * Interface InteroperableEntity
 *
 * Basic interface that all Interoperable Entities MUST implement
 */
interface InteroperableEntity extends Interoperable, IdentifiesById
{

	/**
	 * Create from an array
	 *
	 * @param array $data Data to initialize object with
	 * @return $this
	 */
	public static function fromArray(array $data);
}
