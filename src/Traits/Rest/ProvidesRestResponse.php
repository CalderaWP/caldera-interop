<?php


namespace calderawp\interop\Traits\Rest;

use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Contracts\HttpResponseContract;

trait ProvidesRestResponse
{
	/**
	 * @var array
	 */
	protected $headers;

	/** @var int */
	protected $status;

	/** @var array */
	protected $data;

	/** @var @var string */
	protected $httpMethod;

	/**
	 * @return string
	 */
	public function getHttpMethod() : string
	{
		return $this->httpMethod;
	}

	/**
	 * @param string $httpMethod
	 *
	 * @return ProvidesRestResponse
	 */
	public function setHttpMethod(string$httpMethod) : HttpResponseContract
	{
		$this->httpMethod = $httpMethod;
		return $this;
	}

	/**
	 * Get response data
	 *
	 * @return array
	 */
	public function getData(): array
	{
		return is_array($this->data) ? $this->data : [];
	}

	/**
	 * Get response headers
	 *
	 * @return array
	 */
	public function getHeaders(): array
	{
		return is_array($this->headers) ? $this->headers : [];
	}


	public function getStatus(): int
	{
		return is_numeric($this->status) ? intval($this->status) : 200;
	}

	public function setStatus(int $code): HttpResponseContract
	{
		$this->status=$code;
		return $this;
	}

	public function setHeaders(array $headers): HttpResponseContract
	{
		$this->headers = $headers;
		return $this;
	}

	public function setData(array $data): HttpResponseContract
	{
		$this->data = $data;

		return $this;
	}
}
