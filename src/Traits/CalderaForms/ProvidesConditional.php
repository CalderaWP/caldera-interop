<?php


namespace calderawp\interop\Traits\CalderaForms;

use calderawp\interop\Contracts\CalderaForms\HasConditional;
use calderawp\interop\Contracts\CalderaContract as Caldera;

trait ProvidesConditional
{
	/**
	 * @var HasConditional;
	 */
	private $conditional;

	/**
	 * @return HasConditional
	 */
	public function getConditional(): HasConditional
	{
		return $this->conditional;
	}

	/**
	 * @param HasConditional $conditional
	 *
	 * @return ProvidesConditional
	 */
	public function setConditional(HasConditional $conditional): Caldera
	{
		$this->conditional = $conditional;
		return $this;
	}


}
