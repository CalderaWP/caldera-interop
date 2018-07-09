<?php


namespace calderawp\interop\Contracts;

interface IdentifiesById
{

	/**
	 * Set item ID
	 *
	 * @param  string|int $id
	 * @return $this
	 */
	public function setId($id);

	/**
	 * Get item ID
	 *
	 * @return int
	 */
	public function getId();
}
