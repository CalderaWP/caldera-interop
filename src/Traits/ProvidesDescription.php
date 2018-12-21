<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\HasDescription;

trait ProvidesDescription
{

	/**
	 * @var string
	 */
	protected $description;

	/** @inheritdoc */
	public function getDescription(): string
	{
		return !empty($this->description) ? $this->description : '';
	}


	/** @inheritdoc */
	public function setDescription(string $description): HasDescription
	{
		$this->description = $description;
		return $this;
	}
}
