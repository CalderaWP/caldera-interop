<?php


namespace calderawp\interop\Interfaces;

use calderawp\interop\ServiceContainer;

interface ProvidesService
{

	public function registerService(ServiceContainer $serviceContainer);
}
