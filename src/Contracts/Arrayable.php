<?php


namespace calderawp\interop\Contracts;


interface Arrayable extends \JsonSerializable
{

	/**
	 * Convert object to array
	 *
	 * @return array
	 */
	public function toArray() : array;

}
