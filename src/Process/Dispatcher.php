<?php


namespace calderawp\interop\Process;

use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\DoesProcesses;
use calderawp\interop\Providers\SubmissionsProvider;
use calderawp\interop\Submissions\Collection;
use calderawp\interop\Submissions\Submission;

class Dispatcher
{

	const PRE = 'cf.preProcess.0';
	const PROCESS = 'cf.process.1';
	const POST = 'cf.process.2';

	/**
	 * @var Processor
	 */
	protected $processor;

	/**
	 * @var CalderaFormsApp
	 */
	protected $calderaFormsApp;
	/**
	 * @var string
	 */
	protected $submissionId;

	public function __construct(DoesProcesses $processor, CalderaFormsApp $calderaFormsApp, $submissionId)
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
		/** @var Collection $submissions */
		$submissions =$this->calderaFormsApp->getService(
			SubmissionsProvider::ALIAS
		);
		return $submissions->get($this->submissionId);
	}
}
