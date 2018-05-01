<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface HasId
 *
 * Interface that objects with an identifying key MUST implement
 */
interface HasId
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
	 * @return string|int
	 */
	public function getId();
}
