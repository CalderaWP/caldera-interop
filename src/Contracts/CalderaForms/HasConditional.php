<?php


namespace calderawp\interop\Contracts\CalderaForms;

use calderawp\interop\Contracts\CalderaContract as Caldera;

interface HasConditional
{

	/**
	 * Get the conditional
	 *
	 * @return HasConditional
	 */
	public function getConditional():  HasConditional;

	/**
	 * Set the conditional
	 *
	 * @param HasConditional $conditional
	 *
	 * @return Caldera
	 */
	public function setConditional(HasConditional $conditional):  Caldera;
}
