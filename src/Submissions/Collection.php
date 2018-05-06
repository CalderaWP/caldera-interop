<?php


namespace calderawp\interop\Submissions;

use calderawp\interop\CalderaForms;
use calderawp\interop\Container;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Models\Form;

class Collection extends Container
{
	/** @var  CalderaForms */
	protected $calderaFormsApp;
	public function __construct(CalderaFormsApp $calderaFormsApp)
	{
		$this->calderaFormsApp = $calderaFormsApp;
	}

	/**
	 * Start a new submission
	 *
	 * @param array $rawData
	 * @param Form $form
	 * @param $id
	 * @throws ContainerException
	 */
	public function startNew(array $rawData, Form $form, $id)
	{
		if ($this->has($id)) {
			throw  new ContainerException("Entry id $id is already in collection");
		}
		$entryEntity = $this->calderaFormsApp->getFactory()->entity(CalderaForms::ENTRY);
		$submission = new Submission(
			$rawData,
			$form,
			$this->calderaFormsApp
		);
		$submission->setEntryEntity($entryEntity);
		$submission->setId($id);
		$this->set($id, $submission);
	}
}
