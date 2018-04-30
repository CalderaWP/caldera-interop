<?php

namespace calderawp\interop\Models;

use calderawp\interop\Entities\Entity;
use calderawp\interop\Interfaces\EntitySpecific;
use calderawp\interop\Interfaces\InteroperableModel;
use calderawp\interop\Traits\CanHttp;
use calderawp\interop\Traits\CanRecursivelyCastArray;
use calderawp\interop\Traits\HasId;

abstract class Model implements InteroperableModel, EntitySpecific
{

	use HasId, CanRecursivelyCastArray, CanHttp;

	/**
	 * @var Entity
	 */
	protected $entity;

	/**
	 * @var bool
	 */
	protected $valid;

	/**
	 * Model constructor.
	 *
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity = null)
	{
		$this->entity = $entity;
	}

	/**
	 * @inheritdoc
	 */
	public function isValid()
	{
		return boolval($this->valid);
	}

	/**
	 * @return Entity
	 */
	public function toEntity()
	{
		return $this->entity;
	}

	/**
	 * @inheritdoc
	 */
	public function __get($name)
	{
		return $this->entity->$name;
	}

	/**
	 * @inheritdoc
	 */
	public function __set($name, $value)
	{
		$this->entity->$name = $value;
		return $this;
	}

	/**
	 * @param $id
	 */
	public function setId($id)
	{
		$this->entity->setId($id);
		$this->id = $id;
	}


	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		return $this->entity->toArray();
	}

	/**
	 * @return Entity
	 */
	public function getEntity()
	{
		return $this->toEntity();
	}

	/**
	 * Reset entity of model
	 *
	 * @param  Entity $entity
	 * @return $this
	 */
	public function resetEntity(Entity $entity)
	{
		$this->entity = $entity;
		return $this;
	}

	/**
	 * Cast from array (or stdClass that can be recursively casted to array)
	 *
	 * @param  array|\stdClass $data
	 * @return Entity
	 */
	public static function fromArray($data)
	{
		$obj = new static();
		/**
		 * @var Entity $entity
		 */
		$entity = call_user_func([$obj->getEntityType(), 'fromArray'], self::arrayCastRecursiveStatic($data));
		$obj->resetEntity($entity);
		$obj->setId($entity->getId());
		return $obj;
	}

	/**
	 * Get the type of model
	 *
	 * @return string
	 */
	public function getTheType()
	{
		return strtolower(substr(strrchr(get_class($this), '\\'), 1));
	}
}
