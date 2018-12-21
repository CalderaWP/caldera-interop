<?php


namespace calderawp\interop\Contracts;

interface RestRequestContract
{

	/**
	 * Get parameter from request
	 *
	 * @param string $paramName
	 *
	 * @return mixed
	 */
	public function getParam(string $paramName);

	/**
	 * Set parameter in request
	 *
	 * @param string $paramName
	 * @param mixed $paramValue
	 *
	 * @return $this
	 */
	public function setParam(string $paramName, $paramValue) : RestRequestContract;

	/**
	 * Set parameters of request
	 *
	 * @param array $params
	 *
	 * @return RestRequestContract
	 */
	public function setParams(array $params) : RestRequestContract;

	/**
	 * Get header from request
	 *
	 * @param string $headerName
	 *
	 * @return mixed
	 */
	public function getHeader(string $headerName);

	/**
	 * Set header in request
	 *
	 * @param string $headerName
	 * @param mixed $headerValue
	 *
	 * @return mixed
	 */
	public function setHeader(string $headerName, $headerValue);
}
