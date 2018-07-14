<?php


namespace calderawp\interop\ArrayLike;

use calderawp\interop\Interfaces\Arrayable;
use calderawp\interop\Traits\CanBeAccessedLikeAnArray;

/**
 * Class ArrayLike
 *
 * Basic array-like object.
 *
 * @package calderawp\interop\ArrayLike
 */
abstract class ArrayLike implements \ArrayAccess, Arrayable
{

	use CanBeAccessedLikeAnArray;

	public function __construct(array $items = [])
	{
		$this->items = $items;
	}

	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		return $this->items;
	}
}
