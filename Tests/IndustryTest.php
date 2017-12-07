<?php


class  IndustryTest extends CalderaInteropTestCase
{

    /**
     * Test getting service map array
     *
     * @covers Industry::getServiceMap()
     */
    public function testToServiceMap()
    {

        $serviceContainer = new \calderawp\interop\ServiceContainer();
        $industry =  new \calderawp\interop\Industry($serviceContainer);
        $this->assertEquals( new \calderawp\interop\ServiceMap(), $industry->getServiceMap() );

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
     * Test that factory returns ovveriden entity when it should
     *
     * @covers \calderawp\interop\ServiceMap::registerNamespace()
     * @covers \calderawp\interop\ServiceMap::typeToId()
     * @covers \calderawp\interop\Industry::createEntity()
     */
    public function testOverrideEntity()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();
        $serviceMap->registerNamespace(
            "calderawp\\interop\\Mock\\",
            [
                'Entities.Entry.Details' => \calderawp\interop\Mock\Entity::class
            ]
        );

        $serviceContainer = new \calderawp\interop\ServiceContainer();
        $serviceContainer->resetServiceMap( $serviceMap );
        $industry =  new \calderawp\interop\Industry($serviceContainer);

        $this->assertSame(
            'Entities.Entry.Details',
            $industry->getServiceMap()->typeToId( \calderawp\interop\Entities\Entry\Details::class )
        );

        $this->assertTrue(
            is_a(
                $industry->createEntity( \calderawp\interop\Entities\Entry\Details::class,
                    [
                       [
                           'ID' => uniqid( 'CF' )
                       ]

                    ]
                ),
                '\calderawp\interop\Mock\Entity'
            )
        );

        //double check that default mapping is still correct
        $this->assertTrue(
            is_a(
                $industry->createEntity( \calderawp\interop\Entities\Entry\Field::class,
                    [
                        [

                        ]

                    ]
                ),
                '\calderawp\interop\Entities\Entry\Field'
            )
        );

    }

    /**
     * Test creating Field Entity from industry
     *
     * @covers \calderawp\interop\Industry::createEntity()
     */
    public function testCreateField()
    {

        $industry = $this->industryFactory();

        $this->assertInstanceOf(
            \calderawp\interop\Entities\Field::class,
                $industry->createEntity(
                   \calderawp\interop\Entities\Field::class,
                   [
                       $this->fieldArrayFactory( 'fld1111' )
                   ]
                )
        );

    }

    /**
     * Test creating Form Entity from industry
     *
     * @covers \calderawp\interop\Industry::createEntity()
     */
    public function testCreateForm()
    {

        $industry = $this->industryFactory();

        $this->assertInstanceOf(
            \calderawp\interop\Entities\Form::class,
            $industry->createEntity(
                \calderawp\interop\Entities\Form::class,
                [
                    $this->formArrayFactory( 'cf1234' )
                ]
            )
        );

    }


}