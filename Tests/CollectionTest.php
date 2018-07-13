<?php


namespace calderawp\interop\Tests;


use calderawp\interop\CalderaForms\Entry\EntryEntity;
use calderawp\interop\Collection;

class CollectionTest extends CalderaInteropTestCase
{

    /**
     * @covers \calderawp\interop\Collection::reset()
     * @covers \calderawp\interop\Collection::$elements
     */
    public function testReset()
    {
        $collection = new Collection([new EntryEntity()]);
        $newItems = [];
        $collection->reset($newItems);
        $this->assertAttributeEquals($newItems, 'elements', $collection);

    }
}