<?php


namespace calderawp\interop\Submissions;

use calderawp\CalderaContainers\Service\Container;
use calderawp\interop\CalderaForms;
use calderawp\interop\Entities\Field;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\SanitizesValue;
use calderawp\interop\Models\Form;
use calderawp\interop\Sanitizers\NotSanitized;
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

	/**
	 * @var SanitizesValue
	 */
	private $sanitizer;

	public function __construct(array $rawData, Form $form, CalderaFormsApp $app)
	{
		$this->app = $app;
		$this->serviceContainer = new Container();
		$this->form = $form;
		$this->rawData = $rawData;
		$this->setUpContainer();
		$this->sanitizer = new NotSanitized();
	}

	public function setSanitizer(SanitizesValue $sanitizer)
	{
		$this->sanitizer = $sanitizer;
	}

	/**
	 * @param mixed $value
	 * @return mixed
	 */
	protected function sanitizeValue($value)
	{
		return $this
			->sanitizer
			->process($value);
	}

	/**
	 * @param $fieldId
	 * @param null $default
	 * @return mixed|null
	 */
	public function getRawValue($fieldId, $default = null)
	{
		return array_key_exists($fieldId, $this->rawData) ?
			$this->rawData[$fieldId]
			: $default;
	}

	/**
	 * Get field value
	 *
	 * @param string $identifier Field ID or slug
	 * @return \calderawp\interop\Entities\Entry\Field
	 */
	public function getFieldValue($identifier)
	{
		return $this
			->serviceContainer
			->make($identifier);
	}

	/**
	 * Set a field's value
	 *
	 * @param string $identifier Field ID or slug
	 * @return $this
	 */
	public function setFieldValue($identifier, $newValue)
	{
		$this->getFieldValue($identifier)->setValue($newValue);
		return $this;
	}

	/**
	 * Setup the internal container to lazy-load/ sanitize values
	 */
	private function setUpContainer()
	{
		/** @var Field $field */
		foreach ($this->form->getFields() as $field) {
			$callback = function () use ($field) {
				return $this
					->app
					->getFactory()
					->entity(CalderaForms::ENTRY_VALUE, [
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
			//Identify as slug
			$this->serviceContainer->singleton($field->getSlug(), $callback);
			//Identify as ID
			$this->serviceContainer->singleton($field->getId(), $callback);
		}
	}
}
