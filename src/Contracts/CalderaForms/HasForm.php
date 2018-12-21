<?php


namespace calderawp\interop\Contracts\CalderaForms;

use calderawp\interop\Contracts\CalderaContract as Caldera;

interface HasForm
{

	/**
	 * Get the form
	 *
	 * @return HasForm
	 */
	public function getForm() : HasForm;

	/**
	 * Set the form
	 *
	 * @param HasForm $form
	 *
	 * @return Caldera
	 */
	public function setForm(HasForm $form): Caldera;
}
