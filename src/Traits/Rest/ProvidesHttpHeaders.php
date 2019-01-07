<?php


namespace calderawp\interop\Traits\Rest;

use calderawp\interop\Contracts\Rest\RestRequestContract;
use calderawp\interop\Contracts\HttpRequestContract;
use calderawp\interop\Contracts\HttpResponseContract;

trait ProvidesHttpHeaders
{

	/**
	 * @var array
	 */
	protected $headers;

	/**
	 * Get header from request
	 *
	 * @param string $headerName
	 *
	 * @return string|null
	 */
	public function getHeader(string $headerName)
	{
		return $this->hasHeader($headerName) ? $this->headers[ $headerName ] : null;
	}

	/**
	 * @param string $headerName
	 *
	 * @return bool
	 */
	public function hasHeader(string $headerName): bool
	{

		if (array_key_exists($headerName, $this->getHeaders())) {
			return true;
		}
		return false;
	}


	/**
	 * Set header in request
	 *
	 * @param string $headerName
	 * @param mixed $headerValue
	 *
	 * @return HttpRequestContract
	 */
	public function setHeader(string $headerName, $headerValue): HttpRequestContract
	{
		$this->headers[ $headerName ] = $headerValue;
		return $this;
	}

	/** @inheritdoc */
	public function getHeaders(): array
	{
		return is_array($this->headers) ? $this->headers : [];
	}

	/**
	 * @var string
	 */
	protected $httpMethod;
	/**
	 * Set the HTTP method for the request or response
	 *
	 * @return string
	 */
	public function getHttpMethod() : string
	{
		return is_string($this->httpMethod) ? $this->httpMethod : 'GET';
	}

	/**
	 * Set the HTTP method for the request or response
	 *
	 * @param string $method
	 *
	 * @return ProvidesHttpHeaders
	 */
	public function setHttpMethod(string  $method)
	{

		$this->httpMethod = $method;
		return $this;
	}
}
