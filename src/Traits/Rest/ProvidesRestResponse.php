<?php


namespace calderawp\interop\Traits\Rest;

use calderawp\interop\Contracts\Rest\RestResponseContract;

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

	public function setStatus(int $code): RestResponseContract
	{
		$this->status=$code;
		return $this;
	}

	public function setHeaders(array $headers): RestResponseContract
	{
		$this->headers = $headers;
		return $this;
	}

	public function setData(array $data): RestResponseContract
	{
		$this->data = $data;
		return $this;
	}
}
