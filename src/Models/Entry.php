<?php


namespace calderawp\interop\Models;

use calderawp\interop\CalderaForms;
use calderawp\interop\Entities\Entry as EntryEntity;

class Entry extends Model
{

	/** @inheritdoc */
	public function getEntityType()
	{
		return EntryEntity::class;
	}


	/** @inheritdoc */
	public static function getType()
	{
		return CalderaForms::ENTRY;
	}
}
