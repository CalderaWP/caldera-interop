<?php


namespace calderawp\interop;

/**
 * Class ArrayLike
 *
 * Basic array-like object.
 */
abstract class ArrayLike implements \calderawp\interop\Contracts\ArrayLike
{

	/**
	 * @var array
	 */
	private $items = [];

	public function __construct(array $items = [])
	{
		$this->items = $items;
	}

	/**
	 * @inheritdoc
	 */
	public function toArray(): array
	{
		return $this->items;
	}

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
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->items[] = $value;
		} else {
			$this->items[ $offset ] = $value;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function offsetExists($offset)
	{
		return isset($this->items[ $offset ]);
	}

	/**
	 * @inheritdoc
	 */
	public function offsetUnset($offset)
	{
		unset($this->items[ $offset ]);
	}

	/**
	 * @inheritdoc
	 */
	public function offsetGet($offset)
	{
		return isset($this->items[ $offset ]) ? $this->items[ $offset ] : null;
	}
}
