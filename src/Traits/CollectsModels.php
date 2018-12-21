<?php


namespace calderawp\interop\Traits;
use calderawp\interop\Contracts\InteroperableModelContract;
use calderawp\interop\Contracts\InteroperableCollectionContract;

trait CollectsModels
{

	/**
	 * @var InteroperableModelContract[]
	 */
	protected $items;

	/**
	 * Add item to collection
	 *
	 * @param InteroperableModelContract $item
	 *
	 * @return InteroperableCollectionContract
	 */
	public function addItem(InteroperableModelContract $item) : InteroperableCollectionContract
	{
		call_user_func([$this,$this->setterName()], $item);
		return $this;
	}

	/**
	 * Is item in collection?
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	public function has($id) : bool
	{
		return array_key_exists($id, $this->toArray());

	}

	/**
	 * Get items in collection
	 *
	 * @return array
	 */
	public function toArray() : array
	{
		return is_array($this->items)? $this->items : [];
	}

	abstract protected function setterName(): string;
}
