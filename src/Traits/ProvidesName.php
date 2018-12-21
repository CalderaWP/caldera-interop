<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\CalderaContract as CalderaContract;
use calderawp\interop\Contracts\InteroperableModelContract as Model;

trait ProvidesName
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Model
	 */
	public function setName(string$name): Model
	{
		$this->name = $name;
		return$this;
	}

}
