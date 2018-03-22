<?php


namespace calderawp\interop\Interfaces;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Interface Interoperable
 *
 * Base interface for interoperables, should NOT be used directly. Implement InteroperableModel/Entity/Request/etc instead.
 *
 * @package calderawp\interop\Interfaces
 */
interface Interoperable
{

	/**
	 * @param Request $request
	 * @return Interoperable
	 */
	public static function fromRequest(Request $request);

	/**
	 * @return Response
	 */
	public function toResponse();


	/**
	 * Convert model to array
	 *
	 * @return array
	 */
	public function toArray();
}
