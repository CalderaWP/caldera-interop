<?php


namespace calderawp\interop\Contracts\Rest;

interface Endpoint
{

	/**
	 * Get route URI
	 *
	 * @return string
	 */
	public function getUri(): string;

	/**
	 * Get route arguments
	 *
	 * @return array
	 */
	public function getArgs() : array;

	/**
	 * Get HTTP method for endpoint
	 *
	 * @return string
	 */
	public function getHttpMethod(): string;

	/**
	 * @param string $uri
	 *
	 * @return Endpoint
	 */
	public function setUri(string $uri): Endpoint;

	/**
	 * @param array $args
	 *
	 * @return Endpoint
	 */
	public function setArgs(array $args): Endpoint;

	/**
	 * @param string $httpMethod
	 *
	 * @return Endpoint
	 */
	public function setHttpMethod(string $httpMethod): Endpoint;
}
