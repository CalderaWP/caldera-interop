<?php

namespace calderawp\interop\Models;

use calderawp\interop\Collections\EntityCollections\Fields;
use calderawp\interop\Entities\Form as FormEntity;

class Form extends Model
{
	/** @var Form */
	protected $entity;

	/**
	 * Get fields of form
	 *
	 * @return Fields
	 */
	public function getFields()
	{
		return $this->entity->getFields();
	}

	/**
	 * Get form name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->entity->getName();
	}

	public static function fromArray(array $data)
	{
		self::fixId($data);

		$entity = new FormEntity($data);

		$obj = new static($entity);

		$obj->setId($data[ 'ID' ]);

		return $obj;
	}
}
