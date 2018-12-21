<?php


namespace calderawp\interop\Traits\CalderaForms;

use calderawp\interop\Contracts\CalderaForms\HasConditionals;
use calderawp\interop\Contracts\CalderaContract as Caldera;

trait ProvidesConditionals
{
	/**
	 * @var HasConditionals;
	 */
	private $conditionals;

	/**
	 * @return HasConditionals
	 */
	public function getConditionals(): HasConditionals
	{
		return $this->conditionals;
	}

	/**
	 * @param HasConditionals $conditionals
	 *
	 * @return Caldera
	 */
	public function setConditionals(HasConditionals $conditionals): Caldera
	{
		$this->conditionals = $conditionals;
		return $this;
	}


}
