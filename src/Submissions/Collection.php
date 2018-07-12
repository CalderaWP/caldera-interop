<?php


namespace calderawp\interop\Submissions;

use calderawp\interop\CalderaForms;


class Collection
{
	/** @var  CalderaForms */
	protected $calderaFormsApp;
	public function __construct()
	{
		$this->calderaFormsApp = null;
	}

	/**
	 * Start a new submission
	 *
	 * @param array $rawData
	 * @param Form $form
	 * @param $id
	 * @throws ContainerException
	 *
	 * @return int|string
	 */
	public function startNew(array $rawData, Form $form, $id)
	{

	}
}
