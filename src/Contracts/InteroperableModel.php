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
	 * @param CalderaFormsTwo $calderaForms
	 * @return $this
	 */
	public static function fromEntity(InteroperableEntity $entity, CalderaFormsTwo $calderaForms);


	public function find($id);
	public function findBy($field,$value);
	/**
	 * Get the model's entity
	 *
	 * @return InteroperableEntity
	 */
	public function getEntity();

	/**
	 * Get Caldera Forms instance
	 *
	 * @return CalderaFormsTwo
	 */
	public function getCalderaForms();

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
	public function toResponse(array $headers = []);

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
