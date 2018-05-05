<?php


namespace calderawp\interop\Models\Entry;

use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Models\Model;

class Field extends Model
{

	/** @inheritdoc */
	public function getEntityType()
	{
		return \calderawp\interop\Entities\Entry\Field::class;
	}


	/** @inheritdoc */
	public static function getType()
	{
		return CalderaForms::ENTRY_VALUE;
	}
}
