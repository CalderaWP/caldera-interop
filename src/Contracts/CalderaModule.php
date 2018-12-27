<?php


namespace calderawp\interop\Contracts;

use calderawp\CalderaContainers\Service\Container as ServiceContainer;
use calderawp\caldera\Core\CalderaCoreContract;

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


	public function registerServices(ServiceContainer $container): CalderaModule;

	/**
	 * Get core container
	 *
	 * @return CalderaCoreContract
	 */
	public function getCore() : CalderaCoreContract;
}
