<?php


class IteratingCollectionTest extends CollectionCalderaInteropTestCase
{

    /**
     * Test that an correct entity type is considered correct
     *
     * @covers IteratingCollection::isCorrectEntity()
     */
    public function testIsCorrectEntity()
    {
        $field = [
            'ID' => 'fld41',
            'slug' => 'text_field',
            'config' => [
                'option' => []
            ]
        ];
        $collection  = new \calderawp\interop\Collections\EntityCollections\Fields([$field]);

        $field = new \calderawp\interop\Entities\Field($field);

        $this->assertTrue( $collection->isCorrectEntity($field));

    }

    /**
     * Test that an incorrect entity isn't considered correct
     *
     * @covers IteratingCollection::isCorrectEntity()
     */
    public function testIsNotCorrectEntity()
    {
        $field = [
            'ID' => 'fld41',
            'slug' => 'text_field',
            'config' => [
                'option' => []
            ]
        ];
        $collection  = new \calderawp\interop\Collections\EntityCollections\Fields([$field]);

        $form = new \calderawp\interop\Entities\Form($formArray = $this->formArrayFactory( 42 ));

        $this->assertFalse( $collection->isCorrectEntity($form));

    }

    /**
     * Test creating collection from array of items
     *
     * @covers IteratingCollection::setEntitiesFromArray()
     * @covers IteratingCollection::isCorrectEntity()
     * @covers IteratingCollection::getEntityType()
     */
    public function testFromArray()
    {
        $fields = [
            [
                'ID' => 'fld41',
                'slug' => 'text_field',
                'config' => [
                    'option' => []
                ]
            ],
            [
                'ID' => 'fld42',
                'slug' => 'button',
                'config' => [
                    'option' => []
                ]
            ]
        ];

        $collection = new \calderawp\interop\Collections\EntityCollections\Fields( $fields );
        $this->assertEquals(2, $collection->count() );

        $fieldOne = $collection->getField( 'fld41' );
        $this->assertTrue( is_a( $fieldOne, \calderawp\interop\Entities\Field::class ) );
        $this->assertSame( $fieldOne->getSlug(), 'text_field' );
        $this->assertSame( $fieldOne->getId(), 'fld41' );


        $fieldOne = $collection->getField( 'fld42' );
        $this->assertTrue( is_a( $fieldOne, \calderawp\interop\Entities\Field::class ) );
        $this->assertSame( $fieldOne->getSlug(), 'button' );
        $this->assertSame( $fieldOne->getId(), 'fld42' );
    }


    /**
     *
     * @covers IteratingCollection::mapPosition()
     */
    public function testPositionMap()
    {

    }

    /**
     * Test creating collection from array of items
     *
     * @covers IteratingCollection::current()
     * @covers IteratingCollection::key()
     * @covers IteratingCollection::next()
     * @covers IteratingCollection::valid()
     */
    public function testForeach()
    {
        $fields = [
            [
                'ID' => 'fld41',
                'slug' => 'text_field',
                'config' => [
                    'option' => []
                ]
            ],
            [
                'ID' => 'fld42',
                'slug' => 'button',
                'config' => [
                    'option' => []
                ]
            ]
        ];

        $collection = new \calderawp\interop\Collections\EntityCollections\Fields( $fields );
        $this->assertEquals(2, $collection->count() );

        $i = 0;
        foreach ( $collection as $item ){
            $this->assertTrue( $collection->valid());
            $this->assertSame( $i, $collection->key() );
            $this->assertSame( $collection->current(), $item );
            $this->assertSame( $fields[$i]['ID'], $item->getId() );
            $this->assertTrue( $collection->isCorrectEntity($item));
            $i++;
        }

        //This test fails if no items were returned by loop.
        $this->assertEquals($collection->count(), $i);

    }



}