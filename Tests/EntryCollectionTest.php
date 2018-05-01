<?php


class EntryCollectionTest extends CalderaInteropTestCase
{

	/**
	 * Test that we can magically add forms
	 *
	 * @cover \calderawp\interop\Collections\EntityCollections\Entries::addEntry()
	 * @cover \calderawp\interop\Collections\EntityCollections\EntityCollection::__call()
	 * @cover \calderawp\interop\Collections\EntityCollections\EntityCollection::has()
	 */
	public function testAddEntry(){
		$entryOne = $this->entityFactory( 'ENTRY', 1 );
		$entryTwo = $this->entityFactory( 'ENTRY', 2 );
		$collection = new \calderawp\interop\Collections\EntityCollections\Entries();
		$collection->addEntry($entryOne);
		$collection->addEntry($entryTwo);

		$this->assertTrue(
			$collection->has(1)
		);

		$this->assertTrue(
			$collection->has(2)
		);
	}

	/**
	 * Test that we can magically get Entries
	 *
	 * @cover \calderawp\interop\Collections\EntityCollections\Entries::getEntry()
	 * @cover \calderawp\interop\Collections\EntityCollections\EntityCollection::__call()
	 */
	public function testGetEntry()
	{
		$entryOne = $this->entityFactory( 'ENTRY', 1 );
		$entryTwo = $this->entityFactory( 'ENTRY', 2 );
		$collection = new \calderawp\interop\Collections\EntityCollections\Entries();
		$collection->addEntry($entryOne);
		$collection->addEntry($entryTwo);

		$this->assertEquals(
			$entryOne,
			$collection->getEntry( 1  )
		);

		$this->assertEquals(
			$entryTwo,
			$collection->getEntry( 2  )
		);
	}

}