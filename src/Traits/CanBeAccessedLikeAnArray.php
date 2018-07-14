<?php


namespace calderawp\interop\Traits;

/**
 * Trait CanBeAccessedLikeAnArray
 * Makes objects into interoperable ArrayAccess objects
 */
trait CanBeAccessedLikeAnArray
{
	/**
	 * @var array
	 */
	private $items = [];


	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}
	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		return $this->items;
	}
	
	/**
	 * @inheritdoc
	 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->items[] = $value;
		} else {
			$this->items[$offset] = $value;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function offsetExists($offset)
	{
		return isset($this->items[$offset]);
	}

	/**
	 * @inheritdoc
	 */
	public function offsetUnset($offset)
	{
		unset($this->items[$offset]);
	}

	/**
	 * @inheritdoc
	 */
	public function offsetGet($offset)
	{
		return isset($this->items[$offset]) ? $this->items[$offset] : null;
	}
}
