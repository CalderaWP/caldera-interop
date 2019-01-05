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
}
