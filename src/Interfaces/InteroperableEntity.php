<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface InteroperableEntity
 *
 * Interface that all entities MUST extend
 *
 * @package calderawp\interop\Interfaces
 */
interface InteroperableEntity extends Interoperable, Arrayable, HasId
{
	/**
	 * Create entity from array
	 *
	 * @param  array $items
	 * @return static
	 */
	public static function fromArray(array  $items);


	/**
	 * Get the type of entity
	 *
	 * @return string
	 */
	public function getTheType();
}
