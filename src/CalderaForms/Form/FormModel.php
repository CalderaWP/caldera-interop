<?php


namespace calderawp\interop\CalderaForms\Form;

use calderawp\interop\Collection;
use calderawp\interop\Model;

/**
 * Class FormModel
 * Model for operating on a form
 */
class FormModel extends Model
{

	/**
	 * @return FormEntity
	 */
	public function getEntity()
	{
		return parent::getEntity();
	}

	public function getFields()
	{

		if (! is_a($this->getEntity()->getFields(), Collection::class)) {
			$this->getEntity()->setFields(
				$this
					->getCalderaForms()
				->getField()
			);
		}

		return $this->getEntity()->getFields();
	}
}
