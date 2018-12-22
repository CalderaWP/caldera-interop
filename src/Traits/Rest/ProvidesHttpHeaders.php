<?php


namespace calderawp\interop\Traits\Rest;

use calderawp\interop\Contracts\Rest\RestRequestContract;

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
	 * @return mixed
	 */
	public function setHeader(string $headerName, $headerValue): RestRequestContract
	{
		$this->headers[ $headerName ] = $headerValue;
		return $this;
	}

	protected function getHeaders(): array
	{
		return is_array($this->headers) ? $this->headers : [];
	}
}
