<?php


namespace calderawp\interop\CalderaForms\Entry;

use calderawp\interop\Entity;

/**
 * Class EntryEntity
 * Object abstraction for a Caldera Forms Entry
 */
class EntryEntity extends Entity
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
			'form_id' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'user_id' => [
				'type' => 'array',
				'default' => 0,
				'sanitize' => '',
				'validate' => 'is_numeric'
			],
			'datestamp' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'status' => [
				'type' => 'string',
				'default' => 'pending',
				'sanitize' => '',
				'validate' => 'is_string'
			]
		]);
	}
}
