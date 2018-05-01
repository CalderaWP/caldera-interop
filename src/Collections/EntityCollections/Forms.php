<?php


namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Entities\Form;

class Forms extends EntityCollection
{

	/** @inheritdoc */
	public function getEntitySetter()
	{
		return 'addForm';
	}

	/** @inheritdoc */
	public function getEntityGetter()
	{
		return 'getForm';
	}

	/** @inheritdoc */
	public function getEntityType()
	{
		return Form::class;
	}
}
