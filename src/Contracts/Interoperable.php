<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\Rest\RestRequestContract;

interface Interoperable extends Arrayable, CreatesInteropModelsFromArray, ConvertsToResponse
{

	/**
	 * Create object from REST request.
	 *
	 * @param RestRequestContract $request
	 *
	 * @return static
	 */
	public static function fromRequest(RestRequestContract $request) : Interoperable;
}
