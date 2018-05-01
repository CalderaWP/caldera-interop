<?php


class FormCollectionTest extends CalderaInteropTestCase
{

	/**
	 * Test that we can magically add forms
	 *
	 * @cover \calderawp\interop\Collections\EntityCollections\Forms::addForm()
	 * @cover \calderawp\interop\Collections\EntityCollections\EntityCollection::__call()
	 * @cover \calderawp\interop\Collections\EntityCollections\EntityCollection::has()
	 */
	public function testAddForm(){
		$formOne = $this->entityFactory( 'FORM', 'cf1' );
		$formTwo = $this->entityFactory( 'FORM', 'cf2' );
		$collection = new \calderawp\interop\Collections\EntityCollections\Forms();
		$collection->addForm($formOne);
		$collection->addForm($formTwo);

		$this->assertTrue(
			$collection->has( 'cf1'  )
		);

		$this->assertTrue(
			$collection->has( 'cf2'  )
		);
	}

	/**
	 * Test that we can magically get forms
	 *
	 * @cover \calderawp\interop\Collections\EntityCollections\Forms::getForms()
	 * @cover \calderawp\interop\Collections\EntityCollections\EntityCollection::__call()
	 */
	public function testGetForm()
	{
		$formOne = $this->entityFactory( 'FORM', 'cf1' );
		$formTwo = $this->entityFactory( 'FORM', 'cf2' );
		$collection = new \calderawp\interop\Collections\EntityCollections\Forms();
		$collection->addForm($formOne);
		$collection->addForm($formTwo);

		$this->assertEquals(
			$formOne,
			$collection->getForm( 'cf1'  )
		);

		$this->assertEquals(
			$formTwo,
			$collection->getForm( 'cf2'  )
		);
	}

}