<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface RespondsToRequest
 *
 * Interfaces that an object, such as an interoperable HTTP controller SHOULD implement
 *
 * @package calderawp\interop\Interfaces
 */
interface RespondsToRequest
{

	/**
	 * @param InteroperableRequest $request
	 * @return InteroperabeResponse
	 */
	public function respond(InteroperableRequest $request);
}
