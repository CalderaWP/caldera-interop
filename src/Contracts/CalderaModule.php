<?php


namespace calderawp\interop\Contracts;

use calderawp\CalderaContainers\Service\Container as ServiceContainer;

interface CalderaModule
{

	/**
	 * Get module identifier
	 *
	 * @return string
	 */
	public function getIdentifier():string;

	/**
	 * Get service container of module
	 *
	 * @return ServiceContainer
	 */
	public function getServiceContainer() : ServiceContainer;


	public function registerServices(): CalderaModule;
}
