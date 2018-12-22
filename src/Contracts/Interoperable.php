<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Contracts\Rest\RestRequestContract;

interface Interoperable extends Arrayable, CreatesInteropModelsFromArray
{

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
