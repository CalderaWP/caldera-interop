<?php


namespace calderawp\interop\Contracts;


interface Interoperable extends Arrayable
{

	/**
	 * Create object from array
	 *
	 * @param array $items
	 *
	 * @return static
	 */
	public static function fromArray(array  $items): Interoperable;

	/**
	 * Create object from REST request.
	 *
	 * @param RestRequestContract $request
	 *
	 * @return static
	 */
	public static function fromRequest(RestRequestContract $request) : Interoperable;

	/**
	 * Convert object to REST response
	 *
	 * @return RestResponseContract
	 */
	public function toResponse(): RestResponseContract;
}
