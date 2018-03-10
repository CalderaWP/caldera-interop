<?php

namespace calderawp\interop\Models;

use calderawp\interop\Container;
use calderawp\interop\Entities\Entity;
use calderawp\interop\Traits\HasId;

abstract class Model
{

	use HasId;

	/**
	 * @var Entity
	 */
	protected $entity;

	/**
	 * Model constructor.
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}

	/**
	 * @return Entity
	 */
	public function toEntity()
	{
		return $this->entity;
	}

	/**
	 * @param $id
	 */
	public function setId($id)
	{
		$this->entity->setId($id);
		$this->id = $id;
	}
}
