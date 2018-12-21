<?php


namespace calderawp\interop\Contracts;


interface CreatesInteropModelsFromArray
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
