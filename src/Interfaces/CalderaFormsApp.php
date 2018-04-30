<?php


namespace calderawp\interop\Interfaces;

use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Service\Factory;

/**
 * Interface CalderaFormsApp
 *
 * Interface for the "app" that encapsulates Caldera Forms interop features
 *
 * @package calderawp\interop\Interfaces
 */
interface CalderaFormsApp
{

	/**
	 * Register a service
	 *
	 * @param ProvidesService $service
	 * @return ProvidesService
	 */
	public function registerProvider(ProvidesService $service);

	/**
	 * Get the interop factory
	 *
	 * @return InteroperableFactory|Factory
	 */
	public function getFactory();

	/**
	 * Get a registered service
	 *
	 * @param $alias
	 * @return mixed|object
	 * @throws ContainerException
	 */
	public function getService($alias);
}
