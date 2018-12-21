<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\CalderaContract as Caldera;

interface InteroperableModelContract extends Interoperable
{

	/**
	 * Get the ID
	 *
	 * @return string|int
	 */
	public function getId();

	/**
	 * Set the ID
	 *
	 * @param string|int $id
	 *
	 * @return InteroperableModelContract
	 */
	public function setId($id): InteroperableModelContract;

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName(string $name): InteroperableModelContract;
}
