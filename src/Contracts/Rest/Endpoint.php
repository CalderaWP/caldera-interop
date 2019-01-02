<?php


namespace calderawp\interop\Contracts\Rest;

use calderawp\caldera\restApi\Exception;
use calderawp\interop\Contracts\Rest\RestRequestContract as Request;
use calderawp\interop\Contracts\Rest\RestResponseContract as Response;
use \calderawp\interop\Contracts\TokenContract;


interface Endpoint
{

	/**
	 * Get route URI
	 *
	 * @return string
	 */
	public function getUri(): string;

	/**
	 * Get route arguments
	 *
	 * @return array
	 */
	public function getArgs() : array;

	/**
	 * Get HTTP method for endpoint
	 *
	 * @return string
	 */
	public function getHttpMethod(): string;

	/**
	 * @param string $uri
	 *
	 * @return Endpoint
	 */
	public function setUri(string $uri): Endpoint;

	/**
	 * @param array $args
	 *
	 * @return Endpoint
	 */
	public function setArgs(array $args): Endpoint;

	/**
	 * @param string $httpMethod
	 *
	 * @return Endpoint
	 */
	public function setHttpMethod(string $httpMethod): Endpoint;

	/**
	 * Handle request
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function handleRequest(Request $request) : Response;

	/**
	 * Is request authorized or not?
	 *
	 * @param Request $request
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function authorizeRequest(Request $request) : bool;

	/**
	 * Get CSFR/JWT token string from request
	 *
	 * @param RestRequestContract $request
	 *
	 * @return TokenContract
	 */
	public function getToken( Request $request) : string ;
}
