<?php


namespace calderawp\interop\Models;

use calderawp\interop\CalderaForms;
use \calderawp\interop\Entities\Form as FormEntity;

class Form extends Model
{


	/**
	 * @inheritdoc
	 */
	public function getEntityType()
	{
		return FormEntity::class;
	}


	/**
	 * @return FormEntity
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @return \calderawp\interop\Collections\EntityCollections\Fields
	 */
	public function getFields()
	{
		return $this->entity->getFields();
	}

	/**
	 * @inheritdoc
	 */
	public static function getType()
	{
		return CalderaForms::FORM;
	}
}
