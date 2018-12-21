<?php


namespace calderawp\interop\Contracts;


interface RestResponseContract
{

	/**
	 * Get response data
	 *
	 * @return array
	 */
	public function getData() : array;

	/**
	 * Get response headers
	 *
	 * @return array
	 */
	public function getHeaders(): array ;
}
