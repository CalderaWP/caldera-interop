<?php


namespace calderawp\interop\Contracts;


interface InteroperableCollectionContract
{

	/**
	 * Add item to collection
	 *
	 * @param InteroperableModelContract $item
	 *
	 * @return InteroperableCollectionContract
	 */
	public function addItem(InteroperableModelContract $item) : InteroperableCollectionContract;

	/**
	 * Is item in collection?
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	public function has($id) : bool;

	/**
	 * Get items in collection
	 *
	 * @return array
	 */
	public function toArray() : array;


}
