<?php


class ServiceMapCalderaInteropTest extends CalderaInteropTestCase
{

    /**
     * Test the Arr::has() method this object relies on works in the way we need it to
     *
     * @covers calderawp\interop\Support\Arr::has()
     */
    public function testDotHas()
    {
        $mockArrayMap = [
            'Entities' => [
                'Entry' => [
                    'Entity' => '1',
                    'Details' => '2',
                    'Field' => '3',
                ]
            ]
        ];

        $this->assertTrue( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Entities'  ) );
        $this->assertFalse( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Puppers'  ) );

        $this->assertTrue( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Entities.Entry'  ) );
        $this->assertFalse( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Entities.Puppers'  ) );

        $this->assertTrue( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Entities.Entry.Details'  ) );
        $this->assertFalse( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Entities.Entry.Puppers'  ) );
        $this->assertTrue( \calderawp\interop\Support\Arr::has( $mockArrayMap, 'Entities.Entry.Field'  ) );

    }

    /**
     * Test that items in map report as being there (or not) properly.
     *
     * @covers calderawp\interop\Support\Arr::has()
     * @covers  \calderawp\interop\ServiceMap::has()
     */
    public function testHas()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();
        $this->assertTrue( $serviceMap->has( 'Entities' ) );
        $this->assertFalse( $serviceMap->has( 'Puppers' ) );
        $this->assertTrue( $serviceMap->has( 'Entities.Entry' ) );
        $this->assertFalse( $serviceMap->has( 'Entities.Puppers' ) );
        $this->assertTrue( $serviceMap->has( 'Entities.Entry.Details' ) );
        $this->assertFalse( $serviceMap->has( 'Entities.Entry.Puppers' ) );
    }

    /**
     * Test the Arr::get() method this object relies on works in the way we need it to
     *
     * @covers \calderawp\interop\Support\Arr::get()
     */
    public function testDotGet()
    {
        $mockArrayMap = [
            'Entities' => [
                'Entry' => [
                    'Entity' => '1',
                    'Details' => 2,
                    'Field' => new stdClass(),
                ]
            ]
        ];

        $this->assertEquals(
            $mockArrayMap[ 'Entities' ],
            \calderawp\interop\Support\Arr::get( $mockArrayMap, 'Entities' )
        );

        $this->assertEquals(
            $mockArrayMap[ 'Entities' ][ 'Entry' ],
            \calderawp\interop\Support\Arr::get( $mockArrayMap, 'Entities.Entry' )
        );

        $this->assertEquals(
            $mockArrayMap[ 'Entities' ][ 'Entry' ][ 'Details' ],
            \calderawp\interop\Support\Arr::get( $mockArrayMap, 'Entities.Entry.Details' )
        );

       $this->assertEquals(
           2,
           \calderawp\interop\Support\Arr::get( $mockArrayMap, 'Entities.Entry.Details' )
       );

        foreach ( $mockArrayMap as $key => $value ){
            $this->assertEquals( $value, \calderawp\interop\Support\Arr::get( $mockArrayMap, $key ) );
            if( is_array( $value ) ){
                foreach( $value as $k => $v ){
                    $this->assertEquals( $v, \calderawp\interop\Support\Arr::get( $mockArrayMap, $key . '.' . $k ) );

                }
            }
        }

    }

    /**
     * Test translating ::class reference to id used in map
     *
     * @covers  \calderawp\interop\ServiceMap::typeToId()
     */
    public function testTypeToIdLevelThree()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();

        $this->assertEquals( 'Entities.Entry.Details', $serviceMap->typeToId( \calderawp\interop\Entities\Entry\Details::class ) );

    }

    /**
     * Test that using a dot reference to check if class is in container works
     *
     * @covers  \calderawp\interop\ServiceMap::has()
     */
    public function testHasLevelThree()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();


        $this->assertTrue(
            $serviceMap->has(
                'Entities.Entry.Details'
            )
        );

        $this->assertTrue(
            $serviceMap->has(
                $serviceMap->typeToId(\calderawp\interop\Entities\Entry\Details::class  )
            )
        );

    }

    /**
     * Test that the right ::class reference comes out of getByType
     *
     * @covers  \calderawp\interop\ServiceMap::getByType()
     */
    public function testGetByTypeLevelThree()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();

        $this->assertEquals(
                $serviceMap->getByType( \calderawp\interop\Entities\Entry\Details::class ),
                'calderawp\interop\Entities\Entry\Details'
        );


    }


    /**
     * Test that we get the right reference back when we have two different references that have same class name in different namespaces
     *
     *
     * @covers  \calderawp\interop\ServiceMap::has()
     * @covers  \calderawp\interop\ServiceMap::getByType()
     */
    public function testFieldsCollections()
    {

        $serviceMap = new \calderawp\interop\ServiceMap();


        $this->assertTrue(
            $serviceMap->has(
                'Collections.EntityCollections.Fields'
            )
        );

        $this->assertTrue(
            $serviceMap->has(
                'Collections.EntityCollections.EntryValues'
            )
        );

        $this->assertSame(
            'Collections.EntityCollections.Fields',
            $serviceMap->typeToId(\calderawp\interop\Collections\EntityCollections\Fields::class  )
        );

        $this->assertSame(
            'Collections.EntityCollections.EntryValues.Fields',
            $serviceMap->typeToId(\calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class  )
        );

        $this->assertNotSame(
            $serviceMap->get(
                'Collections.EntityCollections.Fields'
            ),
            $serviceMap->get(
                'Collections.EntityCollections.EntryValues.Fields'
            )
        );



        $this->assertTrue(
            $serviceMap->has(
                $serviceMap->typeToId(\calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class  )
            )
        );


        $this->assertEquals(
            $serviceMap->getByType( \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class  ),
            'calderawp\interop\Collections\EntityCollections\EntryValues\Fields'
        );

    }

    /**
     * Test the get entity method
     *
     *
     * @covers  \calderawp\interop\ServiceMap::getEntity()
     */
    public function testGetEntity()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();
        $this->assertEquals(
            \calderawp\interop\Entities\Entry\Details::class,
            $serviceMap->getEntity( calderawp\interop\Entities\Entry\Details::class )
        );

    }

    /**
     * Test shortcut for calderawp\interop\Entities\Entry reference works
     *
     *
     * @covers  \calderawp\interop\ServiceMap::getEntity()
     */
    public function testGetEntityField()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();
        $this->assertEquals(
            'calderawp\interop\Entities\Entry',
            $serviceMap->getEntity( calderawp\interop\Entities\Entry::class )
        );

    }

    /**
     * Test using getCollection method works right for getting collections
     *
     * @covers  \calderawp\interop\ServiceMap::getCollection()
     */
    public function testGetCollection()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();


        $this->assertEquals(
            'calderawp\interop\Collections\EntityCollections\Fields',
            $serviceMap->getCollection( \calderawp\interop\Collections\EntityCollections\Fields::class )
        );

        $this->assertEquals(
            'calderawp\interop\Collections\EntityCollections\EntryValues\Fields',
            $serviceMap->getCollection( \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class )
        );

    }

    /**
     * Test that mocks entity and collections next few tests will use are instantiable
     *
     * @covers \calderawp\interop\Mock\Entity
     * @covers \calderawp\interop\Mock\Collection
     */
    public function testMocks()
    {

        $entity = new \calderawp\interop\Mock\Entity();
        $this->assertTrue(
            is_object( $entity )
        );
        $collection = new \calderawp\interop\Mock\Collection();
        $this->assertTrue(
            is_object( $collection )
        );



    }


    public function testMapMerge()
    {
        $serviceMap = new \calderawp\interop\ServiceMap();
        $serviceMap->registerNamespace(
            "calderawp\\interop\\Mock\\",
            [
                'Entities.Entry.Field' => \calderawp\interop\Mock\Entity::class
            ]
        );

        //Overriden element is present
        $this->assertTrue(
            $serviceMap->has( 'Entities.Entry.Field' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Entities.Entry' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Entities.Entry.Details' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Entities.Entry.Entity' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Collections.EntityCollections' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Collections.EntityCollections.Fields' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Collections.EntityCollections.EntryValues' )
        );

        $this->assertTrue(
            $serviceMap->has( 'Collections.EntityCollections.EntryValues.Fields' )
        );


    }

    /**
     * Test overriding an entity
     *
     * @covers \calderawp\interop\ServiceMap::registerNamespace()
     * @covers \calderawp\interop\ServiceMap::get()
     * @covers \calderawp\interop\ServiceMap::getEntity()
     */
    public function testRegisterNamespaceWithEntity()
    {

        $serviceMap = new \calderawp\interop\ServiceMap();
        $serviceMap->registerNamespace(
            "calderawp\\interop\\Mock\\",
            [
                'Entities.Entry.Field' => \calderawp\interop\Mock\Entity::class
            ]
        );

        //test that dot notation returns overridden entity ::class reference
        $this->assertSame(
            $serviceMap->get(
                'Entities.Entry.Field'
            ),
            \calderawp\interop\Mock\Entity::class
        );


        //test that ::class reference returns overridden entity ::class reference
        $this->assertSame(
            $serviceMap->getEntity(
                \calderawp\interop\Entities\Entry\Field::class
            ),
            \calderawp\interop\Mock\Entity::class
        );

    }


    /**
     * Test overriding a collection
     *
     * @covers \calderawp\interop\ServiceMap::registerNamespace()
     * @covers \calderawp\interop\ServiceMap::get()
     * @covers \calderawp\interop\ServiceMap::getCollection()
     */
    public function testRegisterNamespaceWithCollection()
    {

        $serviceMap = new \calderawp\interop\ServiceMap();
        $serviceMap->registerNamespace(
            "calderawp\\interop\\Mock\\",
            [
                'Collections.EntityCollections.Fields' => \calderawp\interop\Mock\Collection::class
            ]
        );

        //test that dot notation returns overridden entity ::class reference
        $this->assertSame(
            $serviceMap->get(
                'Collections.EntityCollections.Fields'
            ),
            \calderawp\interop\Mock\Collection::class
        );


        //test that ::class reference returns overridden entity ::class reference
        $this->assertSame(
            $serviceMap->getCollection(
                \calderawp\interop\Collections\EntityCollections\Fields::class
            ),
            \calderawp\interop\Mock\Collection::class
        );

    }

}