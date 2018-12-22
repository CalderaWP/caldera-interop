<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\CreatesInteropCollectionsFromArray;
use calderawp\interop\Contracts\Rest\RestResponseContract;

interface InteroperableCollectionContract extends CreatesInteropCollectionsFromArray
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

	/**
	 * Convert to REST API response
	 *
	 * @return RestResponseContract
	 */
	public function toResponse():RestResponseContract;

	/**
	 * Remove an item from collection
	 *
	 * @param InteroperableModelContract $item
	 *
	 * @return InteroperableCollectionContract
	 */
	public function removeItem(InteroperableModelContract $item) : InteroperableCollectionContract;
}
