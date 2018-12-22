<?php


namespace calderawp\interop\Contracts\Rest;

interface RestResponseContract
{

	/**
	 * @param $items
	 *
	 * @return RestResponseContract
	 */
	public static function fromArray($items) : RestResponseContract;
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

	public function setStatus(int $code): RestResponseContract;

	public function setHeaders(array $headers): RestResponseContract;

	public function setData(array $data): RestResponseContract;
}
