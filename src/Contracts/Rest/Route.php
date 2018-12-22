<?php


namespace calderawp\interop\Contracts\Rest;

interface Route
{

	/**
	 * Add an endpoint to route
	 *
	 * @param Endpoint $endpoint
	 *
	 * @return Route
	 */
	public function addEndpoint(Endpoint $endpoint): Route;

	/**
	 * Get all endpoints of route
	 *
	 * @return array
	 */
	public function getEndpoints(): array;
}
