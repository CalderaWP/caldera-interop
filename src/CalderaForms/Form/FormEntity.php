<?php


namespace calderawp\interop\CalderaForms\Form;

/**
 * Class FormEntity
 *
 * Primary entity for describing a form
 */
class FormEntity extends \calderawp\interop\Entity
{

	public function __construct()
	{
		$this->setAttributes([
			'name' => [
				'type' => 'string',
				'default' => $this->getId(),
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'description' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'fields' => [
				'type' => 'array',
				'default' => [],
				'sanitize' => '',
				'validate' => 'is_array'
			],
			'processors' => [
				'type' => 'array',
				'default' => [],
				'sanitize' => '',
				'validate' => 'is_array'
			]
		]);
	}

	/**
	 * Get the name of the form
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->getProp('name') ? $this->getProp('name') : $this->getId();
	}

	/**
	 * Set the forms form's name
	 *
	 * @param $name
	 * @return FormEntity
	 */
	public function setName($name)
	{
		return $this->setProp('name', $name);
	}

	/**
	 * Get the form's fields
	 *
	 * @return string
	 */
	public function getFields()
	{
		return $this->getProp('fields');
	}

	/**
	 * (re)set the form's fields
	 *
	 * @param array $fields
	 */
	public function setFields($fields)
	{
		$this->setProp('fields', $fields);
	}
}
