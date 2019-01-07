<?php


namespace calderawp\interop\Contracts;

use calderawp\caldera\Forms\FormArrayLike;
use calderawp\caldera\Forms\Processing\ProcessorConfig;
use calderawp\interop\Contracts\FieldsArrayLike as FormFields;
use calderawp\interop\Contracts\Rest\RestRequestContract as Request;

interface ProcessesFormSubmissionContract extends Arrayable
{

	/**
	 * @return ProcessorConfig
	 */
	public function getProcessorConfig() : ProcessorConfig;


	/**
	 * Run the pre-process, validation step
	 *
	 * @param FieldsArrayLike $formFields
	 * @param Request $request
	 *
	 * @return FieldsArrayLike
	 */
	public function preProcess(FormFields $formFields, Request $request): FormFields;

	/**
	 * Run the main process step
	 *
	 * @param FieldsArrayLike $formFields
	 * @param Request $request
	 *
	 * @return FieldsArrayLike
	 */
	public function mainProcess(FormFields $formFields, Request $request): FormFields;

	/**
	 * Run the post-process step
	 *
	 * @param FieldsArrayLike $formFields
	 * @param Request $request
	 *
	 * @return FieldsArrayLike
	 */
	public function postProcess(FormFields $formFields, Request $request): FormFields;


	/**
	 * @return string
	 */
	public function getProcessorType() : string;
}
