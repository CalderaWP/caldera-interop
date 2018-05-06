<?php


namespace calderawp\interop\Collections\EntityCollections\EntryValues;

use calderawp\interop\Collections\EntityCollections\EntityCollection;
use calderawp\interop\Entities\Entry\Field;

/**
 * Class Details
 *
 * Object representation of a collection of entry details entities
 *
 */
class Details extends EntityCollection
{

	/** @inheritdoc */
	public function getEntitySetter()
	{
		return 'addDetail';
	}

	/** @inheritdoc */
	public function getEntityGetter()
	{
		return 'getDetail';
	}

	/** @inheritdoc */
	public function getEntityType()
	{
		return Details::class;
	}

	/**
	 * Check if entry detail is in collection
	 * @param int|string $id
	 * @return bool
	 */
	public function hasEntryDetails($id)
	{
		return $this->has($id);
	}
}
