<?php


namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Entities\Entry;

class Entries extends EntityCollection
{

	/** @inheritdoc */
	public function getEntitySetter()
	{
		return 'addEntry';
	}

	/** @inheritdoc */
	public function getEntityGetter()
	{
		return 'getEntry';
	}

	/** @inheritdoc */
	public function getEntityType()
	{
		return Entry::class;
	}
}
