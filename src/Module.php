<?php


namespace calderawp\interop;

use calderawp\caldera\core\CalderaCore;
use calderawp\CalderaContainers\Service\Container as ServiceContainer;
use calderawp\interop\Contracts\CalderaModule;
use calderawp\caldera\Core\CalderaCoreContract;

abstract class Module implements CalderaModule
{

	/**
	 * @var ServiceContainer
	 */
	protected $serviceContainer;
	/**
	 * @var CalderaCore
	 */
	protected $core;

	public function __construct(CalderaCoreContract $core, ServiceContainer $serviceContainer)
	{
		$this->serviceContainer = $serviceContainer;
		$this->core = $core;
		$this->registerServices($this->serviceContainer);
	}

	/**
	 * @return CalderaCore
	 */
	public function getCore() : CalderaCoreContract
	{
		return $this->core;
	}

	public function getServiceContainer(): ServiceContainer
	{
		return $this->serviceContainer;
	}
}
