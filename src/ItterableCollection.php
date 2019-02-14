<?php


namespace calderawp\interop;
use calderawp\interop\Contracts\Arrayable;


/**
 * Class IteratableCollection
 *
 * Provides implementation of Iterator to subclass and defines what property of parent class is used to store items
 *
 */
abstract class IteratableCollection implements Arrayable, \Iterator
{
	/**
	 * Iterator position
	 *
	 * @var int
	 */
	protected $position = 0;

	/**
	 * Get name of key used to store collection
	 *
	 * Define what property of parent class is used to store items.
	 *
	 * @return string
	 */
	abstract protected function storeKey(): string;


	/**
	 * Get size of collection
	 *
	 * @return int
	 */
	public function count(): int
	{
		$key = $this->storeKey();
		if( ! $this->isCountable($this->$key)){
			return 0;
		}
		return count($this->$key);
	}

	protected function isCountable( $var ) :bool {
		return ( is_array( $var )
			|| $var instanceof \Countable
			|| $var instanceof \SimpleXMLElement
			|| $var instanceof \ResourceBundle
		);
	}
	/**
	 * Check if collection is empty
	 *
	 * @return bool
	 */
	public function empty(): bool
	{
		if (0 == $this->count()) {
			return true;
		}
		return false;
	}


	/**
	 * Increase size of collection
	 *
	 * @param int $size
	 *
	 * @return $this
	 */
	public function increase(int $size)
	{
		$count = $this->count();
		if ($size > $this->count()) {
			$add = $size - $this->count();
			$key = $this->storeKey();
			for ($i = 0; $i < $add; $i++) {
				$this->addEmpty();
			}
		}

		return $this;
	}


	/**
	 * Rewind iterator
	 */
	public function rewind()
	{
		$this->position = 0;
	}

	/**
	 * Get current item in iteration
	 *
	 * @return mixed
	 */
	public function current()
	{
		$key = $this->storeKey();
		return $this->$key[ $this->position ];
	}

	/**
	 * Get current iterator position
	 *
	 * @return int
	 */
	public function key()
	{
		return $this->position;
	}

	/** @inheritdoc */
	public function next()
	{
		++$this->position;
	}

	/**
	 * Check if current item in iterator is valid
	 *
	 * @return bool
	 */
	public function valid()
	{
		$key = $this->storeKey();
		return isset($this->$key[ $this->position ]);
	}

	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

	abstract protected function getItems(): array;

	/** @inheritdoc */
	public function toArray(): array
	{
		$array = [];
		if (!$this->empty()) {
			foreach ($this->getItems() as $item) {
				$array[] = $item->toArray();
			}
		}

		return $array;
	}


}

