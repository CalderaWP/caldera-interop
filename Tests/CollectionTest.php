<?php

namespace calderawp\interop\Tests;

use calderawp\interop\CalderaForms\Entry\EntryEntity;
use calderawp\interop\Collection;

/**
 * Class CollectionTest
 *
 * @covers \calderawp\interop\Collection
 */
class CollectionTest extends CalderaInteropTestCase
{

    /**
     * @covers Collection::reset()
     * @covers Collection::$elements
     */
    public function testReset()
    {
        $collection = new Collection([new EntryEntity()]);
        $newItems = [];
        $collection->reset($newItems);
        $this->assertAttributeEquals($newItems, 'elements', $collection);

    }

    /**
     * @covers Collection::toArray()
     */
    public function testToArray()
    {
        $id = 'r3s';
        $collection = new Collection([
            (new EntryEntity())->setId(rand()),
            (new EntryEntity())->setId($id),
            (new EntryEntity())->setId(rand()),
        ]);
        $this->assertCount( 3, $collection->toArray());
        $this->assertArrayHasKey( $id, $collection->toArray());
    }

    /**
     * @covers Collection::toArray()
     */
    public function testToArrayWithArraysInside()
    {
        $id = 'r3s';
        $collection = new Collection([
           [ 'ID' => 'strange'],
            (new EntryEntity())->setId($id),
        ]);
        $this->assertArrayHasKey( $id, $collection->toArray());
    }

    /**
     * @covers Collection::toArray()
     */
    public function testToArrayWithArraysInsideAreIndexedById()
    {
        $id = 'r3s';
        $idLower = 'r3s3';
        $collection = new Collection([
            [ 'ID' => 'strange'],
            [ 'ID' => $id ],
            [ 'ID' => 42 ],
            [ 'id' => $idLower ],
        ]);
        $this->assertArrayHasKey( $id, $collection->toArray());
        $this->assertArrayHasKey( $idLower, $collection->toArray());
    }
}