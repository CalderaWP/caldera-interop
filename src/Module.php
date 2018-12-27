<?php


namespace calderawp\interop;

use calderawp\CalderaContainers\Service\Container as ServiceContainer;
use calderawp\interop\Contracts\CalderaModule;

abstract class Module implements CalderaModule
{

	/**
	 * @var ServiceContainer
	 */
	protected $serviceContainer;
	public function __construct(ServiceContainer $serviceContainer)
	{
		$this->serviceContainer = $serviceContainer;
		$this->registerServices($this->serviceContainer);
	}

	public function getServiceContainer(): ServiceContainer
	{
		return $this->serviceContainer;
	}
}
