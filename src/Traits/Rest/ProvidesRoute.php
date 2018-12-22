<?php


namespace calderawp\interop\Traits\Rest;

use calderawp\interop\Contracts\Rest\Route;
use calderawp\interop\Contracts\Rest\Endpoint;

trait ProvidesRoute
{
	/** @var Endpoint[] */
	protected $endpoints;
	/**
	 * Add an endpoint to route
	 *
	 * @param Endpoint $endpoint
	 *
	 * @return Route
	 */
	public function addEndpoint(Endpoint $endpoint): Route
	{
		$this->endpoints[] = $endpoint;
		return $this;
	}

	/**
	 * Get all endpoints of route
	 *
	 * @return array
	 */
	public function getEndpoints(): array
	{
		return is_array($this->endpoints) ? $this->endpoints : [];
	}
}
