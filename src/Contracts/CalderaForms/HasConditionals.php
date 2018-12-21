<?php


namespace calderawp\interop\Contracts\CalderaForms;
use calderawp\interop\Contracts\CalderaContract as Caldera;


interface HasConditionals
{

	/**
	 * Get the getConditionals
	 *
	 * @return HasConditionals
	 */
	public function getConditionals():  HasConditionals;

	/**
	 * Set the conditionals
	 *
	 * @param HasConditionals $conditionals
	 *
	 * @return Caldera
	 */
	public function setConditionals(HasConditionals $conditionals):  Caldera;
}
