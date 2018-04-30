<?php


namespace calderawp\interop\Interfaces;

use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Service\Container;

/**
 * Interface InteroperableFactory
 *
 * Interface that service factories MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface InteroperableFactory
{

	/**
	 * Request an entity from the container
	 *
	 * @param string $type of entity
	 * @param null $data
	 *
	 * @return InteroperableEntity
	 * @throws ContainerException Thrown if underlying container does not provide requested entity
	 */
	public function entity($type, $data = null);

	/**
	 * Create a model from an entity that could be provided by this factory
	 *
	 * @param InteroperableEntity $entity
	 * @return InteroperableModel
	 * @throws ContainerException Thrown if underlying container does not provide requested entity
	 */
	public function model($entity);
}
