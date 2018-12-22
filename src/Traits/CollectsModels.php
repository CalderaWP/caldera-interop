<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\InteroperableModelContract as Model;
use calderawp\interop\Contracts\InteroperableCollectionContract as Collection;

trait CollectsModels
{


	use CreatesCollectionFromArray;

	/**
	 * @var Model[]
	 */
	protected $items;

	/**
	 * Add item to collection
	 *
	 * @param Model $item
	 *
	 * @return Collection
	 */
	public function addItem(Model $item) : Collection
	{
		call_user_func([$this,$this->setterName()], $item);
		return $this;
	}

	protected function resetItems($items)
	{
		$this->items = $items;
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
	 * Remove an item from collection
	 *
	 * @param Model $item
	 *
	 * @return Collection
	 */
	public function removeItem(Model $item) : Collection
	{
		if ($this->has($item->getId())) {
			unset($this->items[$item->getId()]);
		}

		return $this;
	}

	/**
	 * Get items in collection
	 *
	 * @return array
	 */
	public function toArray() : array
	{
		$items= is_array($this->items)? $this->items : [];
		foreach ($items as $itemIndex => $item) {
			if (is_object($item)&& is_callable([$item,'toArray'])) {
				try {
					$items[ $itemIndex ] = $item->toArray();
				} catch (\Exception $e) {
					throw $e;
				}
			}
		}
		return $items;
	}

	abstract protected function setterName(): string;
}
