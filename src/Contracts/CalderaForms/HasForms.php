<?php


namespace calderawp\interop\Contracts\CalderaForms;
use calderawp\interop\Contracts\CalderaContract as Caldera;


interface HasForms
{

	/**
	 * Get the forms collection
	 *
	 * @return HasForms
	 */
	public function getForms() : HasForms;

	/**
	 * Set the forms
	 *
	 * @param HasForms $forms
	 *
	 * @return Caldera
	 */
	public function setForms( HasForms $forms ): Caldera;

}
