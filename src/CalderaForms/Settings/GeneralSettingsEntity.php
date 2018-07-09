<?php


namespace calderawp\interop\CalderaForms\Settings;

use calderawp\interop\Entity;

class GeneralSettingsEntity extends Entity
{

	public function __construct()
	{
		$this->setAttributes([
			'alert' => [
				'type' => 'bool',
				'default' => true,
				'sanitize' => '',
				'validate' => ''
			],
			'form' => [
				'type' => 'bool',
				'default' => true,
				'sanitize' => '',
				'validate' => ''
			],
			'grid' => [
				'type' => 'bool',
				'default' => true,
				'sanitize' => '',
				'validate' => ''
			],
			'cdnEnabled' => [
				'type' => 'bool',
				'default' => false,
				'sanitize' => '',
				'validate' => ''
			]
		]);
	}
}
