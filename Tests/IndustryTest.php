<?php


class  IndustryTest extends TestCase
{

    public function testToServiceMap()
    {

        $serviceMap = new \calderawp\interop\ServiceMap();
        $industry = new \calderawp\interop\Industry($serviceMap);
        $this->assertSame( $serviceMap, $industry->getServiceMap() );

    }

    /**
     * Test create fields collection using factory
     *
     * Tests creating a collection that has only optional args
     *
     * @covers  \calderawp\interop\Industry::createCollection()
     */
    public function testCreateFieldsCollection()
    {
        $industry = $this->industryFactory();

        $this->assertTrue(
            is_object(
                $industry->createCollection( \calderawp\interop\Collections\EntityCollections\Fields::class )
            )
        );

        $this->assertTrue(
            is_a(
                $industry->createCollection( \calderawp\interop\Collections\EntityCollections\Fields::class ),
                 '\calderawp\interop\Collections\EntityCollections\Fields'
            )
        );

    }

    /**
     * Test collection factory for EntryValues fields collection
     *
     * Tests passing constructor args through collection factory
     *
     * @covers  \calderawp\interop\Industry::createFactory()
     */
    public function testCreateEntryValuesCollection()
    {
        $industry = $this->industryFactory();
        $this->assertTrue(
            is_object(
                $industry->createCollection( \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class,
                    [
                            [
                                new \calderawp\interop\Entities\Entry\Field(),
                            ]
                    ]
                )
            )
        );

        $this->assertTrue(
            is_a(
                $industry->createCollection( \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class,
                    [
                        0 => [
                            new \calderawp\interop\Entities\Entry\Field(),
                            new \calderawp\interop\Entities\Entry\Field(),
                        ]
                    ]
                ),
                '\calderawp\interop\Collections\EntityCollections\EntryValues\Fields'
            )
        );
    }

    /**
     * Test entity factory
     *
     * @covers  \calderawp\interop\Industry::createEntity()
     */
    public function testCreateEntity()
    {
        $industry = $this->industryFactory();

        $this->assertTrue(
            is_object(
                $industry->createEntity(
                    \calderawp\interop\Entities\Entry::class,
                    [
                        $this->entityFactory( 'ENTRY_DETAILS', 40 ),
                        $this->entityCollectionFactory( 'ENTRY_FIELDS' ),
                        $this->entityFactory( 'FORM', 40 ),

                    ]
                )
            )
        );

        $this->assertTrue(
            is_a(
                $industry->createEntity( \calderawp\interop\Entities\Entry::class,
                    [
                        $this->entityFactory( 'ENTRY_DETAILS', 40 ),
                        $this->entityCollectionFactory( 'ENTRY_FIELDS' ),
                        $this->entityFactory( 'FORM', 40 ),

                    ]
                ),
                '\calderawp\interop\Entities\Entry'
            )
        );

    }

    /**
     * @return \calderawp\interop\Industry
     */
    public function industryFactory()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();
        return new \calderawp\interop\Industry($serviceMap);
    }
}