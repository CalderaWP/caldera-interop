<?php


namespace calderawp\interop\Submissions;


use calderawp\CalderaContainers\Service\Container;
use calderawp\interop\CalderaForms;
use calderawp\interop\Entities\Field;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Models\Form;
use calderawp\interop\Traits\HasId;

class Submission
{
	use HasId;

	/**
	 * @var CalderaFormsApp
	 */
	private $app;
	/**
	 * @var Container
	 */
	private $serviceContainer;

	/**
	 * @var Form
	 */
	private $form;
	/**
	 * @var array
	 */
	private $rawData;
	public function __construct(array $rawData, Form $form, CalderaFormsApp $app )
	{
		$this->app = $app;
		$this->serviceContainer = new Container();
		$this->form = $form;
		$this->rawData = $rawData;
		$this->setUpContainer();
	}


	public function sanitizeValue($value)
	{
		return $value;
	}


	private function setUpContainer()
	{

		/** @var Field $field */
		foreach ( $this->form->getFields() as $field){
			$callback = function() use( $field ){
				return $this
					->app
					->getFactory()
					->entity( CalderaForms::ENTRY_VALUE, [
						'entry_id' => $this->getId(),
						'field_id' => $field->getId(),
						'slug' => $field->getSlug(),
						'value' => $this->sanitizeValue(
							$this->getRawValue(
								$field->getId(),
								$field->getDefault()
							)
						)
					]);
			};
			$this->serviceContainer->bind( $field->getSlug(), $callback );
			$this->serviceContainer->bind( $field->getId(), $callback );
		}
	}

	public function getRawValue($fieldId,$default=null)
	{
		return array_key_exists( $fieldId, $this->rawData ) ?
			$this->rawData[$fieldId]
			: $default;
	}

	/**
	 * Get field value
	 *
	 * @param string $identifier Field ID or value
	 *
	 * @return \calderawp\interop\Entities\Entry\Field
	 */
	public function getFieldValue($identifier)
	{
		return $this
			->serviceContainer
			->make($identifier);

	}


}