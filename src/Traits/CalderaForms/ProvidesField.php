<?php


namespace calderawp\interop\Traits\CalderaForms;

use calderawp\interop\Contracts\CalderaContract as Caldera;
use calderawp\interop\Contracts\CalderaForms\HasField;

trait ProvidesField
{

	/**
	 * @var HasField
	 */
	protected $field;
	/**
	 * Get the field
	 *
	 * @return HasField
	 */
	public function getField(): HasField
	{
		return $this->field;
	}

	/**
	 * Set the field
	 *
	 * @param HasField $field
	 *
	 * @return Caldera
	 */
	public function setField(HasField $field): Caldera
	{
		$this->field = $field;
		return $this;
	}
}
