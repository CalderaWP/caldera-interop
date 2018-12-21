<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockModelCollection;
use calderawp\interop\Contracts\InteroperableModelContract;
use calderawp\interop\Tests\Traits\EntityFactory;
use calderawp\interop\Traits\CollectsModels;

class MockModelCollectionTest extends TestCase
{

	use EntityFactory;
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

	/**
	 * @covers \calderawp\interop\Traits\CreatesCollectionFromArray::fromArray()
	 */
	public function testFromArray(){

		$fields = $this->getFields();
		$collection =  MockModelCollection::fromArray([
			'fields' => $fields
		]);
		$this->assertAttributeEquals( $fields, 'fields', $collection );
	}
	/**
	 * @covers \calderawp\interop\Traits\CollectsModels::has()
	 * @covers \calderawp\interop\Traits\CollectsModels::addItem()
	 */
	public function testCanHaveMultipleItems()
	{
		$id = 'fld1';
		$field = \Mockery::mock( 'Hat', InteroperableModelContract::class );
		$field->shouldReceive('getId' )->andReturn($id);

		$id2 = 'fld2';
		$field2 = \Mockery::mock( 'Hat', InteroperableModelContract::class );
		$field2->shouldReceive('getId' )->andReturn($id2);
		$collection = new MockModelCollection();
		$collection->addItem($field);
		$collection->addItem($field2);
		$this->assertTrue($collection->has($id));
		$this->assertTrue($collection->has($id2));
		$this->assertFalse( $collection->has('fasdfda'));
		$this->assertFalse( $collection->has(42));
	}

	/**
	 * @covers \calderawp\interop\Traits\CollectsModels::has()
	 * @covers \calderawp\interop\Traits\CollectsModels::removeItem()
	 */
	public function testCanRemoveItemsItems()
	{
		$id = 'fld1';
		$field = \Mockery::mock( 'Hat', InteroperableModelContract::class );
		$field->shouldReceive('getId' )->andReturn($id);

		$id2 = 'fld2';
		$field2 = \Mockery::mock( 'Hat', InteroperableModelContract::class );
		$field2->shouldReceive('getId' )->andReturn($id2);
		$collection = new MockModelCollection();
		$collection->addItem($field);
		$collection->addItem($field2);
		$this->assertTrue($collection->has($id));
		$this->assertTrue($collection->has($id2));

		$collection->removeItem($field);
		$this->assertFalse($collection->has($id));
		$this->assertTrue($collection->has($id2));
	}
}
