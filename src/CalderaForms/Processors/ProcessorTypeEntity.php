<?php


namespace calderawp\interop\CalderaForms\Processors;

use calderawp\interop\Entity;

class ProcessorTypeEntity extends Entity
{

	public function __construct()
	{
		$this->setAttributes([
			'type' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'meta' => [
				'type' => 'array',
				'default' => '',
				'sanitize' => '',
				'validate' => 'array'
			],
			'configFields' => [
				'type' => 'array',
				'default' => [],
				'sanitize' => '',
				'validate' => 'is_array'
			],
			'label' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			]
		]);
	}
}
