<?php
use \calderawp\interop\Submissions\Submission;

class SubmissionTest extends CalderaInteropTestCase
{

	/**
	 * Test getting raw value from submission
	 *
	 * @covers Submission::getRawValue():
	 */
    public function testRawValueGet()
	{
		$fieldOneId = uniqid('fld' );
		$fieldOneValue = md5( $fieldOneId . rand() );
		$fieldTwoId = uniqid('fld' );
		$fieldTwoValue = md5( $fieldTwoId . rand() );

		$submission = $this->createSubmission($fieldOneId, $fieldTwoId, $fieldOneValue, $fieldTwoValue);

		$this->assertSame( $fieldOneValue, $submission->getRawValue($fieldOneId));
		$this->assertSame( $fieldTwoValue, $submission->getRawValue($fieldTwoId));

	}

	/**
	 * Get field value object and test its value was set correctly.
	 *
	 * @covers Submission::getFieldValue():
	 */
	public function testFieldValueGet()
	{
		$fieldOneId = uniqid('fld' );
		$fieldOneValue = md5( $fieldOneId . rand() );
		$fieldTwoId = uniqid('fld' );
		$fieldTwoValue = md5( $fieldTwoId . rand() );

		$submission = $this->createSubmission($fieldOneId, $fieldTwoId, $fieldOneValue, $fieldTwoValue);
		$this->assertSame( $fieldOneValue, $submission->getFieldValue($fieldOneId)->getValue());
		$this->assertSame( $fieldTwoValue, $submission->getFieldValue($fieldTwoId)->getValue());
	}

	/**
	 * @param $fieldOneId
	 * @param $fieldTwoId
	 * @param $fieldOneValue
	 * @param $fieldTwoValue
	 * @return \calderawp\interop\Submissions\Submission
	 */
	protected function createSubmission($fieldOneId, $fieldTwoId, $fieldOneValue, $fieldTwoValue)
	{
		$fieldOne = $this->entityFactory('FIELD', $fieldOneId);
		$fieldTwo = $this->entityFactory('FIELD', $fieldTwoId);

		$rawData = [
			$fieldOneId => $fieldOneValue,
			$fieldTwoId => $fieldTwoValue
		];

		$fields = new \calderawp\interop\Collections\EntityCollections\Fields([
			$fieldOne,
			$fieldTwo,
		]);

		$formId = uniqid('cf');
		/** @var \calderawp\interop\Entities\Form $formEntity */
		$formEntity = $this->entityFactory('FORM', $formId);
		$formEntity->setFields($fields);
		$form = new \calderawp\interop\Models\Form($formEntity, $fields);
		$submission = new Submission(
			$rawData,
			$form,
			$this->createApp()
		);
		return $submission;
	}


}