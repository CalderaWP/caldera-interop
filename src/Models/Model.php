<?php

namespace calderawp\interop\Models;

use calderawp\interop\ControlledContainer;
use calderawp\interop\Entities\Entity;
use calderawp\interop\Interfaces\EntitySpecific;
use calderawp\interop\Interfaces\Interoperable;
use function calderawp\interop\Interop;
use calderawp\interop\Traits\CanRecursivelyCastArray;
use calderawp\interop\Traits\HasId;
use NetRivet\WordPress\Http\Response;
use Psr\Http\Message\RequestInterface as Request;

abstract class Model implements Interoperable, EntitySpecific
{

	use HasId, CanRecursivelyCastArray;

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
	public static function fromRequest(Request $request)
	{
		$pre = Interop()
			->getEventsManager()
			->applyFilters(
				static::getType() . '.model.preDispatchRequest',
				null,
				[$request]
			);

		if (is_a($pre, static::class)) {
			return $pre;
		}
		$body = json_decode($request->getBody()->getContents());
		return self::fromArray($body);
	}


	/**
	 * @inheritdoc
	 */
	public function toResponse()
	{
		$response = $pre = Interop()
			->getEventsManager()
			->applyFilters(
				static::getType() . '.model.preDispatchResponse',
				new Response($this->toArray()),
				[$this]
			);

		return $response;
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
		return $this->entity;
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
	 * Get type
	 *
	 * @return string
	 */
	public function getTheType()
	{
		return strtolower(substr(strrchr(get_class($this), '\\'), 1));
	}
}
