<?php


namespace calderawp\interop\Traits\Rest;

use calderawp\interop\Contracts\Rest\Endpoint;

trait ProvidesRestEndpoint
{
	/** @var string */
	protected $uri;
	/** @var array */
	protected $args;
	/** @var string */
	protected $httpMethod;




	/**
	 * @param string $uri
	 *
	 * @return Endpoint
	 */
	public function setUri(string $uri): Endpoint
	{
		$this->uri = $uri;
		return $this;
	}

	/**
	 * @param array $args
	 *
	 * @return Endpoint
	 */
	public function setArgs(array $args): Endpoint
	{
		$this->args = $args;
		return $this;
	}

	/**
	 * @param string $httpMethod
	 *
	 * @return Endpoint
	 */
	public function setHttpMethod(string $httpMethod): Endpoint
	{
		$this->httpMethod = $httpMethod;
		return $this;
	}

	/**
	 * Get route URI
	 *
	 * @return string
	 */
	public function getUri(): string
	{

		return $this->uri;
	}

	/**
	 * Get route arguments
	 *
	 * @return array
	 */
	public function getArgs() : array
	{
		return $this->args;
	}

	/**
	 * Get HTTP method for endpoint
	 *
	 * @return string
	 */
	public function getHttpMethod(): string
	{
		return $this->httpMethod;
	}
}
