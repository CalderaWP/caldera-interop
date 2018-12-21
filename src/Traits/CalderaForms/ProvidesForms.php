<?php


namespace calderawp\interop\Traits\CalderaForms;

use calderawp\interop\Contracts\CalderaForms\HasForms;
use calderawp\interop\Contracts\CalderaContract as Caldera;

trait ProvidesForms
{
	/**
	 * @var HasForms
	 */
	protected $forms;

	/**
	 * Get the forms
	 *
	 * @return HasForms
	 */
	public function getForms() : HasForms
	{
		return $this->forms;
	}

	/**
	 * Set the forms
	 *
	 * @param HasForms $forms
	 *
	 * @return Caldera
	 */
	public function setForms(HasForms $forms) : Caldera
	{
		$this->forms = $forms;
		return $this;
	}
}
