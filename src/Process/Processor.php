<?php


namespace calderawp\interop\Process;

use calderawp\interop\Interfaces\ControlsProcessing;
use calderawp\interop\Interfaces\DoesProcesses;
use calderawp\interop\Submissions\Submission;

abstract class Processor implements DoesProcesses
{

	/**
	 * The pre-process control
	 *
	 * @var ControlsProcessing
	 */
	protected $preProcessController;

	/**
	 * The process controller
	 *
	 * @var ControlsProcessing
	 */
	protected $processController;

	/**
	 * The post-process controller
	 *
	 * @var ControlsProcessing
	 */
	protected $postProcessController;

	/**
	 * Processor slug
	 *
	 * @var string
	 */
	protected $slug;

	/**
	 * Processor constructor.
	 * @param string $slug
	 * @param ControlsProcessing|null $preProcessor
	 * @param ControlsProcessing $processor
	 * @param ControlsProcessing $postProcessor
	 */
	public function __construct($slug, ControlsProcessing $preProcessor = null, ControlsProcessing $processor, ControlsProcessing $postProcessor)
	{
		$this->slug = $slug;
		$this->preProcessController = $preProcessor;
		$this->processController = $processor;
		$this->postProcessController = $postProcessor;
	}
}
