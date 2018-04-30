<?php


namespace calderawp\interop\Service;

use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Interfaces\InteroperableEntity;
use calderawp\interop\Interfaces\InteroperableFactory;
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
	public function __construct(InteroperableServiceContainer $container)
	{
		$this->container = $container;
	}


	public function registerInterop()
	{

	}


	/** @inheritdoc */
	public function getContainer()
	{
		return $this->container;
	}

	/** @inheritdoc */
	public function entity($type, $data = null)
	{
		if ($this->isProvidedEntity($type)) {
			if (is_array($data)) {
				/** @var InteroperableEntity $type */
				return $type::fromArray($data);
			}

			if (is_object($data)
				&&(  is_a($data, InteroperableRequest::class) || is_a($data, RequestInterface::class) )
			) {
					/** @var InteroperableEntity $type */
					return $type::fromRequest($data);
			}
			return $this->getContainer()->make($type);
		}

		throw new ContainerException(sprintf('Entity of type %s could not be resolved via entity service', $type));
	}

	/** @inheritdoc */
	public function model($entity)
	{
		if (!$this->isProvidedEntity(get_class($entity))) {
			throw new ContainerException(sprintf(
				'Entity of type %s could not be resolved via entity service', get_class()));
		}

	}
	/**
	 * Check if this type of entity can be created by this factory
	 *
	 * @param string $type Class reference to entity type
	 * @return bool
	 */
	protected function isProvidedEntity($type)
	{
		return $this->
			getContainer()
			->doesProvide($type);
	}
}
