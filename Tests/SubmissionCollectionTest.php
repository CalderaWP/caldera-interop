<?php


class SubmissionCollectionTest extends CalderaInteropTestCase
{

	/**
	 * Test starting a new submission
	 *
	 * @covers \calderawp\interop\Submissions\Collection::startNew()
	 * @covers \calderawp\interop\Submissions\Collection::get()
	 */
	public function testStart()
	{
		$fieldIdOne = 'fld1';
		$fieldIdTwo = 'fld2';
		$fieldIds = [
			$fieldIdOne,
			$fieldIdTwo
		];
		$form = $this->formModelFactory($fieldIds);
		$rawData = [];
		foreach($fieldIds as $fieldId ){
			$rawData[$fieldId] = md5($fieldId);
		}
		$collection = new \calderawp\interop\Submissions\Collection($this->createApp());
		$id = rand();
		$collection->startNew( $rawData, $form,$id);
		/** @var \calderawp\interop\Submissions\Submission $submission */
		$submission = $collection->get($id);
		$this->assertSame( $rawData[$fieldIds[0]], $submission->getRawValue($fieldIdOne) );
		$this->assertSame( $rawData[$fieldIds[1]], $submission->getRawValue($fieldIdTwo) );
	}

	/**
	 * Test that we can NOT have two submissions with same ID
	 *
	 * @covers \calderawp\interop\Submissions\Collection::startNew()
	 * @covers \calderawp\interop\Submissions\Collection::has()
	 */
	public function testInvalidStart()
	{
		$form = $this->formModelFactory(['fld1']);
		$rawData = [
			'fld1' => random_bytes(12 )
		];

		$collection = new \calderawp\interop\Submissions\Collection($this->createApp());
		$id = rand();
		$collection->startNew( $rawData, $form, $id);
		$this->setExpectedException(\calderawp\interop\Exceptions\ContainerException::class);
		$collection->startNew( $rawData, $form, $id);


	}
}