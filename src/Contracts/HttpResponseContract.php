<?php


namespace calderawp\interop\Contracts;

interface HttpResponseContract
{

	/**
	 * @param $items
	 *
	 * @return HttpResponseContract
	 */
	public static function fromArray($items) : HttpResponseContract;
	/**
	 * Get response data
	 *
	 * @return array
	 */
	public function getData(): array;

	/**
	 * Get response headers
	 *
	 * @return array
	 */
	public function getHeaders(): array;


	public function getStatus(): int;

	public function setStatus(int $code): HttpResponseContract;

	public function setHeaders(array $headers): HttpResponseContract;

	public function setData(array $data): HttpResponseContract;

	/**
	 * Set the HTTP method for the request or response
	 *
	 * @return string
	 */
	public function getHttpMethod() : string;

	/**
	 * Set the HTTP method for the request or response
	 *
	 * @param string $method
	 *
	 * @return HttpResponseContract
	 */
	public function setHttpMethod(string  $method) : HttpResponseContract;
}
