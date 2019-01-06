<?php


namespace calderawp\interop\Contracts;

use calderawp\caldera\Forms\FormArrayLike;
use calderawp\caldera\Forms\Processing\ProcessorConfig;
use calderawp\interop\Contracts\FieldsArrayLike as FormFields;
use calderawp\interop\Contracts\Rest\RestRequestContract as Request;

interface ProcessorContract extends Arrayable
{

	/**
	 * @return ProcessorConfig
	 */
	public function getProcessorConfig() : ProcessorConfig;
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
	 * Run the pre-process, validation step
	 *
	 * @param FieldsArrayLike $formFields
	 *
	 * @return FieldsArrayLike
	 */
	public function preProcess(FormFields $formFields, Request $request): FormFields;

	/**
	 * Run the main process step
	 *
	 * @param FieldsArrayLike $formFields
	 *
	 * @return FieldsArrayLike
	 */
	public function mainProcess(FormFields $formFields, Request $request): FormFields;

	/**
	 * Run the post-process step
	 *
	 * @param FieldsArrayLike $formFields
	 *
	 * @return FieldsArrayLike
	 */
	public function postProcess(FormFields $formFields, Request $request): FormFields;

	/**
	 * Get current form as array-like object
	 *
	 * @return FormArrayLike
	 */
	public function getForm() : FormArrayLike;

	/**
	 * @return string
	 */
	public function getProcessorType() : string;
}
