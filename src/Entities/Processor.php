<?php

namespace calderawp\interop\Entities;

use calderawp\interop\Support\Str;
use calderawp\interop\Traits\CanCastAndValidateProps;
use calderawp\interop\Traits\Types\ProcessorType;

/**
 * Class Processor
 *
 * Object representation of a Caldera Forms entity
 */
class Processor extends Entity
{
	use CanCastAndValidateProps, ProcessorType;

	/**
	 * @var string
	 */
	protected $slug;

	/**
	 * @var array
	 */
	protected $config;

	/** @inheritdoc */
	protected $casts = [
		'slug' => 'string',
		'config' => 'array'
	];

	/**
	 * Ensure slugs are snake cased
	 *
	 * @param string $slug
	 * @return string
	 */
	protected function validateSlug($slug)
	{
		return Str::snake($slug);
	}

	/**
	 * Apply default shape to config array
	 *
	 * @param array $newValue
	 * @return array
	 */
	protected function validateConfig($newValue)
	{
		return array_merge($this->getConfigShapeWithDefaults(), $newValue );
	}

}