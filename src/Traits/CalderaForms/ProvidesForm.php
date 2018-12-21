<?php


namespace calderawp\interop\Traits\CalderaForms;
use calderawp\interop\Contracts\CalderaForms\HasForm;
use calderawp\interop\Contracts\CalderaContract as Caldera;

trait ProvidesForm
{
	/**
	 * @var HasForm
	 */
	protected $form;

	/**
	 * Get the form
	 *
	 * @return HasForm
	 */
	public function getForm() : HasForm
	{
		return $this->form;
	}

	/**
	 * Set the form
	 *
	 * @param HasForm $form
	 *
	 * @return Caldera
	 */
	public function setForm(HasForm $form) : Caldera
	{
		$this->form = $form;
		return $this;
	}
}
