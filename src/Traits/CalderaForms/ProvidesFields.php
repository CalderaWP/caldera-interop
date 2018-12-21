<?php


namespace calderawp\interop\Traits\CalderaForms;

use calderawp\interop\Contracts\CalderaContract as Caldera;
use calderawp\interop\Contracts\CalderaForms\HasFields;

trait ProvidesFields
{

	protected $fields;
	/**
	 * Get the fields
	 *
	 * @return HasFields
	 */
	public function getFields(): HasFields
	{
		return $this->fields;
	}

	/**
	 * Set the fields
	 *
	 * @param HasFields $fields
	 *
	 * @return Caldera
	 */
	public function setFields(HasFields $fields): HasFields
	{
		$this->fields = $fields;
		return $this;
	}
}
