<?php


namespace calderawp\interop\Models;


use calderawp\interop\Entities\Entry as EntryEntity;
class Entry extends Model
{

	public function getEntityType()
	{
		return EntryEntity::class;
	}


	/**
	 * @inheritdoc
	 */
	public static function getType()
	{
		return 'entry';
	}
}
