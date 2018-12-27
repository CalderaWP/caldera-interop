<?php


namespace calderawp\interop\Traits;

trait IteratesArray
{
	public $position;
	public function __construct()
	{
		$this->position = 0;
	}

	public function rewind()
	{
		$this->position = 0;
	}

	public function current()
	{
		return $this->items[$this->position];
	}

	public function key()
	{
		return $this->items;
	}

	public function next()
	{
		if (! is_int($this->position)) {
			$this->position = 0;
		}
		++$this->position;
	}

	public function valid()
	{
		return isset($this->items[$this->position]);
	}
}
