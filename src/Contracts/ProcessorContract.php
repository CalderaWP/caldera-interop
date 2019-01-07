<?php


namespace calderawp\interop\Contracts;

use calderawp\caldera\Forms\FormArrayLike;
use calderawp\caldera\Forms\Processing\ProcessorConfig;
use calderawp\interop\Contracts\FieldsArrayLike as FormFields;
use calderawp\interop\Contracts\Rest\RestRequestContract as Request;

interface ProcessorContract extends Arrayable, ProcessesFormSubmissionContract
{


	/**
	 * Check if processor should run, based on conditionals
	 *
	 * @return bool
	 */
	public function checkConditionals(): bool;

	/**
	 * Get processor's label
	 *
	 * @return string
	 */
	public function getLabel() : string;


	/**
	 * Create item from array
	 *
	 * @param array $item
	 *
	 * @return ProcessorContract
	 */
	public static function fromArray(array $item = []) : ProcessorContract;


	/**
	 * Get current form as array-like object
	 *
	 * @return FormArrayLike
	 */
	public function getForm() : FormArrayLike;
}
