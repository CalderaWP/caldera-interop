<?php


namespace calderawp\interop\Collections;

use calderawp\interop\Entities\Entity;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Interfaces\CollectsEntities;
use calderawp\interop\Interfaces\CreateFromStdClass;
use calderawp\interop\Interfaces\EntitySpecific;
use calderawp\interop\Interfaces\InteroperableEntity;
use calderawp\interop\Traits\CanCastObjectToArray;

abstract class IteratingCollection implements \Iterator, CreateFromStdClass, EntitySpecific
{

	use CanCastObjectToArray;
	/**
	 * Collection items
	 *
	 * @var array
	 */
	protected $items;

	/**
	 * Current iterator position
	 *
	 * @var int
	 */
	protected $position;

	/**
	 * Maps entity ID to position for iteration
	 *
	 * @var array
	 */
	private $positionMap;

	/**
	 * Get number of items in collection
	 *
	 * @return integer
	 */
	final public function count()
	{
		return count($this->items);
	}

	/**
	 * IteratingCollection constructor.
	 *
	 * @param Entity[] $items Optional. Array of compatible entities
	 */
	public function __construct(array  $items = [])
	{
		$this->position = 0;
		if (! empty($items)) {
			$this->setEntitiesFromArray($items, $this);
		}
	}

	/**
	 * @param $id
	 * @return int
	 */
	protected function mapPosition($id)
	{
		$this->positionMap[] = $id;
		return count($this->positionMap) -1;
	}

	/**
	 * Create collection from array
	 *
	 * @param  Entity[] $data Array of compatible entities
	 * @return static
	 */
	public static function fromArray(array $data)
	{
		$obj = new static;
		$obj->setEntitiesFromArray($data, $obj);
		return $obj;
	}

	/**
	 * @inheritdoc
	 */
	public static function fromStdClass($data)
	{

		$obj = new static();
		if (! empty($data)) {
			foreach ($data as $datum) {
				$entity = call_user_func([ $obj->getEntityType(), 'fromStdClass'], $datum);
				call_user_func([$obj,$obj->getEntitySetter()], $entity);
			}
		}

		return $obj;
	}

	/**
	 * Set an array of entities on the object
	 *
	 * @param Entity[]    $data Array of compatible entities
	 * @param static|null $obj  Object to set on. If null $this is used.
	 *
	 * @throws ContainerException
	 */
	public function setEntitiesFromArray(array $data, $obj = null)
	{
		if (! $obj) {
			$obj = $this;
		}
		foreach ($data as $entity) {
			if (! $this->isCorrectEntity($entity)) {
				$entity = $this->maybeCastObject($entity);
				if (is_array($entity)) {
					$entity = call_user_func([ $this->getEntityType(), 'fromArray'], $entity);
				}
			}

			if ($this->isCorrectEntity($entity)) {
				call_user_func([$obj, $obj->getEntitySetter()], $entity);
			} else {
				throw new ContainerException(sprintf('Not valid type to set as entity. Type is: %s. Type should be %s', getType($entity), $this->getEntityType()));
			}
		}
	}

	/**
	 * Is object (or whatever) the correct entity type
	 *
	 * @param  Entity|array|\stdClass $maybeEntity
	 * @return bool
	 */
	public function isCorrectEntity($maybeEntity)
	{
		return is_object($maybeEntity) && is_a($maybeEntity, $this->getEntityType());
	}

	/**
	 * @inheritdoc
	 */
	public function rewind()
	{
		$this->position = 0;
	}

	/**
	 * @inheritdoc
	 */
	public function current()
	{
		return $this->items[$this->positionMap[$this->position]];
	}

	/**
	 * @inheritdoc
	 */
	public function key()
	{
		return $this->position;
	}

	/**
	 * @inheritdoc
	 */
	public function next()
	{
		++$this->position;
	}

	/**
	 * @inheritdoc
	 */
	public function valid()
	{
		return isset($this->positionMap[$this->position], $this->items[$this->positionMap[$this->position]]);
	}

	/**
	 * Add an entity to collection
	 *
	 * @param  InteroperableEntity $entity
	 * @return $this
	 */
	protected function addEntity(InteroperableEntity $entity)
	{
		$this->items[ $entity->getId() ] = $entity;
		$this->mapPosition($entity->getId());
		return $this;
	}

	/**
	 * Get a Entity by ID
	 *
	 * @param  int $id
	 * @return InteroperableEntity|null
	 */
	protected function getEntity($id)
	{
		return isset($this->items[ $id ]) ? $this->items[ $id ] : null;
	}

	/** @inheritdoc */
	public function toArray()
	{
		$fields = [];

		foreach ($this->items as $entity) {
			$fields[ $entity->getId() ] = $entity->toArray();
		}
		return $fields;
	}
}
