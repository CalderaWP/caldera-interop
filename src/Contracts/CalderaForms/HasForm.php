<?php


namespace calderawp\interop\Contracts\CalderaForms;

use calderawp\interop\Contracts\InteroperableModelContract as Model;

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
	 * @return Model
	 */
	public function setForm(HasForm $form): Model;
}
