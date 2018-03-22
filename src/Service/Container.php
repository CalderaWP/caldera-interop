<?php


namespace calderawp\interop\Service;

use calderawp\interop\Interfaces\InteroperableServiceContainer;
use calderawp\interop\Interfaces\ProvidesService;

/**
 * Class Container
 *
 * Primary service container for interop. Should NOT be used directly. Designed to be injected into a service factory.
 *
 * @package calderawp\interop\Service
 */
class Container implements InteroperableServiceContainer
{

	/**
	 * @var ProvidesService[]
	 */
	protected $services;

	/** @inheritdoc */
	public function doesProvide($serviceName)
	{
		if (! is_array($this->services)) {
			$this->services = [];
		}

		return ! empty($this->services) && array_key_exists($serviceName, $this->services);
	}

	/** @inheritdoc */
	public function bind($alias, $concrete)
	{
		$this->services[$alias] = $concrete;
	}

	/** @inheritdoc */
	public function make($alias)
	{
		if (! isset($this->services[$alias])) {
			return $this->resolve($alias);
		}
		if (is_callable($this->services[$alias])) {
			return call_user_func_array($this->services[$alias], array($this));
		}

		if (is_object($this->services[$alias])) {
			return $this->services[$alias];
		}

		if (class_exists($this->services[$alias])) {
			return $this->resolve($this->services[$alias]);
		}

		return $this->resolve($alias);
	}

	/** @inheritdoc */
	public function singleton($alias, $binding)
	{
		$this->services[$alias] = $binding;
	}


	private function resolve($class)
	{
		$reflection = new \ReflectionClass($class);

		$constructor = $reflection->getConstructor();

		// Constructor is null
		if (! $constructor) {
			return new $class;
		}

		// Constructor with no parameters
		$params = $constructor->getParameters();

		if (count($params) === 0) {
			return new $class;
		}

		$newInstanceParams = array();

		foreach ($params as $param) {
			// @todo Here we should probably perform a bunch of checks, such as:
			// isArray(), isCallable(), isDefaultValueAvailable()
			// isOptional() etc.

			if (is_null($param->getClass())) {
				$newInstanceParams[] = null;
				continue;
			}

			$newInstanceParams[] = $this->make(
				$param->getClass()->getName()
			);
		}

		return $reflection->newInstanceArgs(
			$newInstanceParams
		);
	}
}
