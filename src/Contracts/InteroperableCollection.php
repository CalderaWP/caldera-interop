<?php


namespace calderawp\interop\Contracts;

use Doctrine\Common\Collections\Collection;

/**
 * Interface InteroperableCollection
 *
 * Interface that all collections of Interoperable entities or models MUST implement
 *
 * Enforces that our collections extend  Doctrine Collections
 * @see https://www.doctrine-project.org/projects/doctrine-collections/en/latest/index.html
 */
interface InteroperableCollection extends Collection
{
	/**
	 * Set the type of entity being collected
	 *
	 * @param string $type The type identifier
	 * @return $this
	 */
	public function setType($type);

	/**
	 * Get the type of entity being collected
	 *
	 * @return string
	 */
	public function getType();

	/**
	 * Reset collection to a new set of items
	 * @param array $items
	 * @return $this
	 */
	public function reset(array $items);
}
