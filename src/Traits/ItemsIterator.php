<?php


namespace calderawp\interop\Traits;

/**
 * Provides implementation of \IteratorAggregate that loops property items used by most types of collections.
 */
trait ItemsIterator
{

	public function getIterator()
	{
		$items = is_array($this->items) ? $this->items : [];
		return new \ArrayIterator($items);
	}
}
