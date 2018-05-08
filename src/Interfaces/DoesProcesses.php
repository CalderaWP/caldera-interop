<?php


namespace calderawp\interop\Interfaces;

use calderawp\interop\Submissions\Submission;

interface DoesProcesses
{

	public function preProcess(Submission$submission);

	public function process(Submission$submission);


	public function postProcess(Submission$submission);
}
