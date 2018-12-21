<?php


namespace calderawp\interop\Contracts;


interface CreatesFromArray
{
	/**
	 * Create object from array
	 *
	 * @param array $items
	 *
	 * @return static
	 */
	public static function fromArray(array  $items): Interoperable;
}
