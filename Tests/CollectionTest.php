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
}