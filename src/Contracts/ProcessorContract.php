<?php


namespace calderawp\interop\Contracts;
use calderawp\caldera\Forms\FormArrayLike;
use calderawp\caldera\Forms\Processing\ProcessorConfig;
use calderawp\interop\Contracts\UpdateableFormFieldsContract as FormFields;
use calderawp\interop\Contracts\Rest\RestRequestContract as Request;

interface ProcessorContract
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
	 * Run the pre-process, validation step
	 *
	 * @param UpdateableFormFieldsContract $formFields
	 *
	 * @return UpdateableFormFieldsContract
	 */
	public function preProcess(FormFields $formFields, Request $request ): FormFields;

	/**
	 * Run the main process step
	 *
	 * @param UpdateableFormFieldsContract $formFields
	 *
	 * @return UpdateableFormFieldsContract
	 */
	public function mainProcess(FormFields $formFields, Request $request ): FormFields;

	/**
	 * Run the post-process step
	 *
	 * @param UpdateableFormFieldsContract $formFields
	 *
	 * @return UpdateableFormFieldsContract
	 */
	public function postProcess(FormFields $formFields, Request $request ): FormFields;

	/**
	 * Get current form as array-like object
	 *
	 * @return FormArrayLike
	 */
	public function getForm() : FormArrayLike;

	/**
	 * @return string
	 */
	public function getProcessorType() : string ;
}
