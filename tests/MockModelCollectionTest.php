<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockModelCollection;
use calderawp\interop\Contracts\InteroperableModelContract;
use calderawp\interop\Traits\CollectsModels;

class MockModelCollectionTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\CollectsModels::addItem()
	 */
	public function testAddItem()
	{
		$id = 'fld1';
		$field = \Mockery::mock( 'Hat', InteroperableModelContract::class );
		$field->shouldReceive('getId' )->andReturn($id);
		$collection = new MockModelCollection();
		$collection->addItem($field);
		$this->assertAttributeEquals([$field->getId() => $field ], 'items', $collection );


	}

	/**
	 * @covers \calderawp\interop\Traits\CollectsModels::has()
	 * @covers \calderawp\interop\Traits\CollectsModels::toArray()
	 */
	public function testHasArrayOfItemsIfNoneSet()
	{

		$collection = new MockModelCollection();
		$this->assertEquals([], $collection->toArray());
	}

	/**
	 * @covers \calderawp\interop\Traits\CollectsModels::has()
	 * @covers \calderawp\interop\Traits\CollectsModels::toArray()
	 */
	public function testHas()
	{
		$id = 'fld1';
		$field = \Mockery::mock( 'Hat', InteroperableModelContract::class );
		$field->shouldReceive('getId' )->andReturn($id);
		$collection = new MockModelCollection();
		$collection->addItem($field);
		$this->assertTrue($collection->has($id));
		$this->assertFalse( $collection->has('fasdfda'));
		$this->assertFalse( $collection->has(42));
	}
}
