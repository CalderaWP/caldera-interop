<?php


namespace calderawp\interop\Process;

use calderawp\interop\CalderaForms;
use calderawp\interop\Contracts\CalderaFormsTwo;
use calderawp\interop\Contracts\DoesProcesses;
use calderawp\interop\Submissions\Collection;
use calderawp\interop\Submissions\Submission;

class Dispatcher
{

	const PRE = 'cf.core.preProcess.0';
	const PROCESS = 'cf.core.process.1';
	const POST = 'cf.core.process.2';

	/**
	 * @var Processor
	 */
	protected $processor;

	/**
	 * @var CalderaForms
	 */
	protected $calderaFormsApp;
	/**
	 * @var string
	 */
	protected $submissionId;

	public function __construct(DoesProcesses $processor, CalderaFormsTwo $calderaFormsApp, $submissionId)
	{
		$this->processor = $processor;
		$this->calderaFormsApp = $calderaFormsApp;
		$this->submissionId = $submissionId;
	}


	public function dispatchProcess($step)
	{
		switch ($step) {
			case self::PRE:
				$this
				 ->processor
				 ->preProcess($this->getSubmission());
				break;
			case self::PROCESS:
				$this
					->processor
					->process($this->getSubmission());
				break;
			case self::POST:
				$this
					->processor
					->postProcess($this->getSubmission());
				break;
		}
	}

	/**
	 * @return Submission
	 */
	private function getSubmission()
	{

	}
}
