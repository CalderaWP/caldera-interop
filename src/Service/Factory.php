<?php


namespace calderawp\interop\Service;

use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Exceptions\Exception;
use calderawp\interop\Interfaces\CollectsEntities;
use calderawp\interop\Interfaces\InteroperableEntity;
use calderawp\interop\Interfaces\InteroperableFactory;
use calderawp\interop\Interfaces\InteroperableModel;
use calderawp\interop\Interfaces\InteroperableRequest;
use calderawp\interop\Interfaces\InteroperableServiceContainer;
use Psr\Http\Message\RequestInterface;

/**
 * Class Factory
 *
 * Factory that provides entities, models and collections.
 *
 * @package calderawp\interop\Service
 */
class Factory implements InteroperableFactory
{
	/**
	 * @var InteroperableServiceContainer
	 */
	protected $container;

	/**
	 * @var array
	 */
	protected $map;
	public function __construct(InteroperableServiceContainer $container)
	{
		$this->container = $container;
	}

	/**
	 * Bind an interoprable set (entity, model, collection
	 *
	 * @param string $identifierPrefix Main identifier used for container resolution.
	 * @param string $entityClassRef Class ref (::class) for entity.
	 * @param string $modelClassRef Class ref (::class) for model.
	 * @param string $collectionClassRef Class ref (::class) for container.
	 * @return $this
	 */
	public function bindInterop($identifierPrefix, $entityClassRef, $modelClassRef, $collectionClassRef)
	{
		$this->mapEntity($identifierPrefix, $entityClassRef);


		$this
			->getContainer()
			->bind(
				$this->modelRef($identifierPrefix),
				function () use ($modelClassRef) {
					return new $modelClassRef;
				}
			);

		$this
			->getContainer()
			->bind(
				$this->collectionRef($identifierPrefix),
				function () use ($collectionClassRef) {
					return new $collectionClassRef();
				}
			);
		return $this;
	}

	/**
	 * Get a entity reference
	 *
	 * @param string $identifierPrefix Main identifier used for container resolution.
	 * @return string
	 */
	public function entityRef($identifierPrefix)
	{
		return $identifierPrefix . '.entity';
	}

	/**
	 * Get a model reference
	 *
	 * @param string $identifierPrefix Main identifier used for container resolution.
	 * @return string
	 */
	public function modelRef($identifierPrefix)
	{
		return $identifierPrefix . '.model';
	}

	/**
	 * Get a model collection
	 *
	 * @param $identifierPrefix
	 * @return string
	 */
	public function collectionRef($identifierPrefix)
	{
		return $identifierPrefix . '.collection';
	}
	/**
	 * Get service container used by this factory
	 *
	 * @return InteroperableServiceContainer
	 */
	protected function getContainer()
	{
		return $this->container;
	}

	/** @inheritdoc */
	public function entity($type, $data = null)
	{
		if ($this->isProvidedEntity($type)) {
			if (! $data) {
				return $this
					->getContainer()
					->make(
						$this->entityRef($type)
					);
			}
			$ref = $this->getEntityClassRef($type);
			if (is_array($data)) {
				/** @var InteroperableEntity $ref */
				return $ref::fromArray($data);
			}

			if (is_object($data)
				&&(  is_a($data, InteroperableRequest::class)
					|| is_a($data, RequestInterface::class)
				)
			) {
					/** @var InteroperableEntity $ref */
					return $ref::fromRequest($data);
			}
		}

		throw new ContainerException(sprintf('Entity of type %s could not be resolved via entity service', $type));
	}

	/** @inheritdoc */
	public function model($entity,CollectsEntities $collection = null )
	{
		$type = $entity->getTheType();
		if (!$this->isProvidedModel($type)) {
			throw new ContainerException(sprintf(
				'Model for entity type %s could not be resolved via entity service',
				$type
			));
		}
		/** @var InteroperableModel $model */
		$model = $this->container->make($this->modelRef($type));
		$model
			->setEntity($entity)
			->setCollection(
				$this->collection($type)
			);
		return $model;
	}

	/**
	 * @param $type
	 * @return mixed|object
	 * @throws ContainerException
	 */
	public function collection($type){
		if (!$this->isProvidedCollection($type)) {
			throw new ContainerException(sprintf(
				'Collections of type %s could not be resolved via collection service',
				$type
			));
		}
		if( $this->isProvidedCollection($type)){
			return $this
				->getContainer()
				->make(
					$this->collectionRef($type)
				);
		}
	}

	/**
	 * Check if this type of entity can be created by this factory
	 *
	 * @param string $type Type of entity
	 * @return bool
	 */
	protected function isProvidedEntity($type)
	{
		return $this->
			getContainer()
			->doesProvide(
				$this->entityRef($type)
			);
	}

	/**
	 * Check if this type of model can be created by this factory
	 *
	 * @param string $type Type of model
	 * @return bool
	 */
	protected function isProvidedModel($type)
	{
		return $this->
			getContainer()
				->doesProvide(
					$this->modelRef($type)
				);
	}

	/**
	 * Check if this type of model can be created by this factory
	 *
	 * @param string $type Type of collection
	 * @return bool
	 */
	protected function isProvidedCollection($type)
	{
		return $this->
		getContainer()
			->doesProvide(
				$this->collectionRef($type)
			);
	}

	/**
	 * Get entity class reference to use mapped entity statically.
	 *
	 * @param string $identifierPrefix Main identifier used for container resolution.
	 * @return string
	 */
	private function getEntityClassRef($identifierPrefix)
	{
		return $this->map[$identifierPrefix];
	}

	/**
	 * @param string $identifierPrefix Main identifier used for container resolution.
	 * @param string $entityClassRef Class ref (::class) for entity.
	 */
	private function mapEntity($identifierPrefix, $entityClassRef)
	{
		$this->map[$identifierPrefix]=$entityClassRef;
		$this
			->getContainer()
			->bind(
				$this->entityRef($identifierPrefix),
				function () use ($entityClassRef) {
					return new $entityClassRef;
				}
			);
	}
}
