<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\InteroperableModelContract as Model;

trait ProvidesIdGeneric
{
	/**
	 * @var string|int
	 */
	protected $id;

	/**
	 * Get the ID
	 *
	 * @return string|int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the ID
	 *
	 * @param string|int $id
	 *
	 * @return Model
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
}
