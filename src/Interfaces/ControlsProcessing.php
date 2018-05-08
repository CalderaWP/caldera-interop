<?php


namespace calderawp\interop\Interfaces;

use calderawp\interop\Submissions\Submission;

/**
 * Interface ControlsProcessing
 *
 * Interface that ALL process controllers MUST implement
 */
interface ControlsProcessing
{

	/**
	 * @param Submission $submission
	 * @return mixed
	 */
	public function process(Submission $submission);
}
