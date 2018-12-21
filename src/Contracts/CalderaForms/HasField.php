<?php


namespace calderawp\interop\Contracts\CalderaForms;
use calderawp\interop\Contracts\CalderaContract as Caldera;


interface HasField
{

	/**
	 * Get the field
	 *
	 * @return HasField
	 */
	public function getField():  HasField;

	/**
	 * Set the field
	 *
	 * @param HasField $field
	 *
	 * @return Caldera
	 */
	public function setField(HasField $field):  Caldera;
}
