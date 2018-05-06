<?php
use \calderawp\interop\Submissions\Submission;
use \calderawp\interop\Models\Form;
class SubmissionTest extends CalderaInteropTestCase
{
	/**
	 * @var Form
	 */
	protected $formModel;

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
	 * @covers Submission::setUpContainer()
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
	 * Test we can change/use sanitizer
	 *
	 * @covers Submission::setSanitizer()
	 * @covers Submission::sanitizeValue()
	 * @covers Submission::setUpContainer()
	 * @covers NoTags::process()
	 */
	public function testSetSanitizer()
	{
		$fieldOneId = uniqid('fld' );
		$fieldOneValue = '<script>alert(1)</script><p>Hi Roy</p>';
		$fieldTwoId = uniqid('fld' );
		$fieldTwoValue = md5( $fieldTwoId . rand() );

		$submission = $this->createSubmission($fieldOneId, $fieldTwoId, $fieldOneValue, $fieldTwoValue);
		$submission->setSanitizer( new \calderawp\interop\Sanitizers\NoTags() );
		$this->assertSame( 'alert(1)Hi Roy', $submission->getFieldValue($fieldOneId)->getValue());
		$this->assertSame( $fieldTwoValue, $submission->getFieldValue($fieldTwoId)->getValue());
	}

	/**
	 * Test getting a field by slug
	 *
	 * @covers Submission::setUpContainer()
	 * @covers Submission::getFieldValue():
	 */
	public function testGetBySlug()
	{
		$fieldOneId = uniqid('fld' );
		$fieldOneValue = 'fieldONEvalue';
		$fieldTwoId = uniqid('fld' );
		$fieldTwoValue = 'fieldTWOvalue';

		$submission = $this->createSubmission($fieldOneId, $fieldTwoId, $fieldOneValue, $fieldTwoValue);
		$fieldTwo = $this->formModel->getFields()->getField($fieldTwoId);
		$fieldOne = $this->formModel->getFields()->getField($fieldOneId);

		$this->assertSame( $fieldOneId, $fieldOne->getId() );
		$this->assertSame( $fieldTwoId, $fieldTwo->getId() );

		$this->assertSame( $fieldOneValue, $submission->getFieldValue($fieldOneId)->getValue());
		$this->assertSame( $fieldTwoValue, $submission->getFieldValue($fieldTwoId)->getValue());

		$this->assertSame( $fieldOneValue, $submission->getFieldValue($fieldOne->getSlug())->getValue());
		$this->assertSame( $fieldTwoValue, $submission->getFieldValue($fieldTwo->getSlug())->getValue());
	}

	/**
	 * Ensure we can change field values
	 *
	 * Makes sure we're using the same field value objects, not creating new ones
	 *
	 * @covers Submission::setFieldValue()
	 */
	public function testSetValue()
	{

		$fieldOneId = uniqid('fld' );
		$fieldOneValue = 'fieldONEvalue';
		$fieldTwoId = uniqid('fld' );
		$fieldTwoValue = 'fieldTWOvalue';
		$newValue = 'fieldOneCHANGED';
		$submission = $this->createSubmission($fieldOneId, $fieldTwoId, $fieldOneValue, $fieldTwoValue);

		$submission->setFieldValue( $fieldOneId, $newValue );
		$this->assertSame( $newValue, $submission->getFieldValue($fieldOneId)->getValue());
		$this->assertSame( $fieldTwoValue, $submission->getFieldValue($fieldTwoId)->getValue());

	}

	/**
	 * Test submission ID gets updated with entry ID
	 * @covers Submission::setEntryEntity()
	 */
	public function testSetEntity()
	{

		$submission = $this->createSubmission();
		$entryEntity = $this->entityFactory( 'ENTRY' );
		$submission->setEntryEntity($entryEntity);
		$this->assertSame( $entryEntity, $submission->getEntry() );
		$submission->getEntry()->setId(42);
		$this->assertSame( 42, $submission->getId() );


	}

	/**
	 * Test entry ID gets updated with submission ID
	 *
	 * @covers Submission::setEntryEntity()
	 * @covers Submission::setId()
	 */
	public function testEntryIdUpdate()
	{
		$submission = $this->createSubmission();
		$entryEntity = $this->entityFactory( 'ENTRY' );
		$submission->setEntryEntity($entryEntity);

		$submission->setId(500);
		$this->assertSame( 500, $submission->getEntry()->getId() );
	}

	/**
	 * @param string $fieldOneId
	 * @param string $fieldTwoId
	 * @param string $fieldOneValue
	 * @param string $fieldTwoValue
	 * @return \calderawp\interop\Submissions\Submission
	 */
	protected function createSubmission($fieldOneId ='fld111', $fieldTwoId = 'fld123', $fieldOneValue = 'f1v', $fieldTwoValue = 'f2v')
	{
		$fieldOne = $this->entityFactory('FIELD', $fieldOneId);
		$fieldTwo = $this->entityFactory('FIELD', $fieldTwoId);
		$fieldTwo->setSlug( 'fieldTwoSlug' );
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
		$this->formModel = new \calderawp\interop\Models\Form($formEntity, $fields);

		$submission = new Submission(
			$rawData,
			$this->formModel,
			$this->createApp()
		);
		return $submission;
	}




}