<?php


namespace calderawp\interop\CalderaForms\Settings;

use calderawp\interop\Entity;

class PrivacySettingsEntity extends Entity
{

	public function __construct()
	{
		$this->setAttributes([
			'formId' => [
				'type' => 'string',
				'default' => $this->getId(),
				'sanitize' => '',
				'validate' => ''
			],
			'privacy_exporter_enabled' => [
				'type' => 'bool',
				'default' => false,
				'sanitize' => '',
				'validate' => ''
			],
			'personally_identifying_fields' => [
				'type' => 'array',
				'default' => [],
				'sanitize' => '',
				'validate' => 'is_array'
			],
			'email_identifying_fields' => [
				'type' => 'array',
				'default' => [],
				'sanitize' => '',
				'validate' => 'is_array'
			],
		]);
	}
}
