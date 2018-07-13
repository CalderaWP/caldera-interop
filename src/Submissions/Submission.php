<?php


namespace calderawp\interop\Submissions;

use calderawp\interop\CalInterop;
use calderawp\interop\CalderaForms\Form\FormEntity;
use calderawp\interop\Contracts\CalderaFormsInteropComponent;

class Submission
{
	use HasId;

	/**
	 * @var CalInterop
	 */
	private $calderaForms;


	/**
	 * @var CalderaForms\Form\FormEntity
	 */
	private $form;
	/**
	 * @var array
	 */
	private $rawData;


	/**
	 * @var CalderaForms\Entry\EntryEntity
	 */
	protected $entry;

	public function __construct(array $rawData, FormEntity $form, CalderaFormsInteropComponent $calderaForms)
	{
		$this->calderaForms = $calderaForms;
		$this->form = $form;
		$this->rawData = $rawData;
	}

	/**
	 * (re)Set Entry entity
	 *
	 * @param CalderaForms\Entry\EntryEntity $entry
	 * @return $this
	 */
	public function setEntryEntity(CalderaForms\Entry\EntryEntity $entry)
	{

		return $this;
	}

	/** @inheritdoc */
	public function setId($id)
	{
		if ($this->entry) {
			$this->entry->setId($id);
		}
		$this->id = $id;
		return $this;
	}
}
