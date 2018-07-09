<?php


namespace calderawp\interop\CalderaForms\Entry;

use calderawp\interop\Entity;

/**
 * Class EntryMetaEntity
 * Object abstraction for a Caldera Forms Entry meta value
 */
class EntryMetaEntity extends Entity
{
	/** @inheritdoc */
	public function __construct()
	{
		$this->setAttributes([
			'meta_id' => [
				'type' => 'string',
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
			'process_id' => [
				'type' => 'array',
				'default' => 0,
				'sanitize' => '',
				'validate' => 'is_numeric'
			],
			'meta_key' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => 'is_string'
			],
			'meta_value' => [
				'type' => 'string',
				'default' => '',
				'sanitize' => '',
				'validate' => ''
			]
		]);
	}
}
