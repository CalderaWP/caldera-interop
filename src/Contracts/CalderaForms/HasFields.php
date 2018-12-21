<?php


namespace calderawp\interop\Contracts\CalderaForms;
use calderawp\interop\Contracts\CalderaContract as Caldera;


interface HasFields
{

	/**
	 * Get the fields
	 *
	 * @return HasFields
	 */
	public function getFields():  HasFields;

	/**
	 * Set the fields
	 *
	 * @param HasFields $fields
	 *
	 * @return Caldera
	 */
	public function setFields(HasFields $fields):  Caldera;
}
