<?php


namespace calderawp\interop\Models\Entry;

use calderawp\interop\CalderaForms;
use calderawp\interop\Models\Model;

class Details extends Model
{

	/** @inheritdoc */
	public function getEntityType()
	{
		return \calderawp\interop\Entities\Entry\Details::class;
	}


	/** @inheritdoc */
	public static function getType()
	{
		return CalderaForms::ENTRY_DETAILS;
	}
}
