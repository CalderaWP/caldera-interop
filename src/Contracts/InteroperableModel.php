<?php


namespace calderawp\interop\Contracts;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface InteroperableModel extends Interoperable
{
	/**
	 * Construct new model from an entity
	 *
	 * @param InteroperableEntity $entity
	 * @return $this
	 */
	public static function fromEntity(InteroperableEntity $entity);

	/**
	 * Get the model's entity
	 *
	 * @return InteroperableEntity
	 */
	public function getEntity();

	/**
	 * Create new Model from HTTP request
	 *
	 * @param RequestInterface $request
	 * @return $this
	 */
	public static function fromRequest(RequestInterface $request);

	/**
	 * Convert entity to HTTP response

     * @param array $headers Opitonal. Array of response headers
     * @return ResponseInterface
     */
	public function toResponse(array $headers = [] );

    /**
     * Is entity valid
     *
     * @return bool
     */
	public function isValid();

    /**
     * Set the entity status code
     *
     * @param int $statusCode
     * @return $this
     */
	public function setStatusCode($statusCode = 200);
}
