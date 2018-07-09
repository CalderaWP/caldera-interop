<?php


namespace calderawp\interop\CalderaForms\Entry;

use calderawp\interop\Entity;

/**
 * Class EntryFieldEntity
 * Object abstraction for a Caldera Forms Entry field value
 */
class EntryFieldEntity extends Entity
{
	/** @inheritdoc */
	public function __construct()
	{
		$this->setAttributes([
			'id' => [
				'type' => 'id',
				'default' => $this->getId(),
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'entry_id' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'field_id' => [
				'type' => 'array',
				'default' => 0,
				'sanitize' => '',
				'validate' => 'is_numeric'
			],
			'slug' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'value' => [
				'type' => 'string',
				'default' => 'pending',
				'sanitize' => '',
				'validate' => 'is_string'
			]
		]);
	}
}
