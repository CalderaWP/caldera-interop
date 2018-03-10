<?php

/**
 * Class FormModelTest
 *
 * @covers \calderawp\interop\Models\Form
 */
class FormModelTest extends ModelCalderaInteropTestCase
{

    /**
     * Test getting type static
     *
     * @covers Form::getType()
     */
    public function testGetType()
    {
        $this->assertSame('form', \calderawp\interop\Models\Form::getType() );
    }

    /**
     * Test getting type
     *
     * @covers Form::getType()
     */
    public function testGetTheType()
    {
        $formEntity = $this->entityFactory( 'FORM' );
        $formModel = new \calderawp\interop\Models\Form( $formEntity );
        $this->assertSame('form', $formModel->getTheType() );

    }

    /**
	 * Test get entity from model
	 *
	 * @covers  \calderawp\interop\Models\Model::toEntity();
	 * @covers  \calderawp\interop\Form\Model::toEntity();
	 */
	public function testToEntity()
	{
		$formEntity = $this->entityFactory( 'FORM' );
		$formModel = new \calderawp\interop\Models\Form( $formEntity );
		$this->assertEquals( $formEntity, $formModel->toEntity() );
	}

	/**
	 * @covers  \calderawp\interop\Entities\Form::getField()
	 * @covers  \calderawp\interop\Models\Form::addField();
	 */
	public function testGetField()
	{

		$fieldEntity = $this->entityFactory( 'FIELD', 7 );
		/** @var \calderawp\interop\Entities\Form $formEntity */
		$formEntity = $this->entityFactory( 'FORM' );
		$formEntity->addField( $fieldEntity );
		$formModel = new \calderawp\interop\Models\Form( $formEntity );
		$this->assertEquals( $fieldEntity, $formModel->getFields()->getField(7 ) );

	}

	/**
	 * Test getting multiple fields
	 *
	 * @covers  \calderawp\interop\Entities\Form::getField()
	 * @covers  \calderawp\interop\Entities\Form::toArray()
	 * @covers  \calderawp\interop\Models\Form::getFields();
	 */
	public function testGetFields()
	{

		$fieldEntity7 = $this->entityFactory( 'FIELD', 7 );
		$fieldEntity2 = $this->entityFactory( 'FIELD', 2 );
		/** @var \calderawp\interop\Entities\Form $formEntity */
		$formEntity = $this->entityFactory( 'FORM' );
		$formEntity->addField( $fieldEntity2 )->addField( $fieldEntity7 );
		$formModel = new \calderawp\interop\Models\Form( $formEntity );

		$fields = $formModel->getFields()->toArray();

		$this->assertArrayHasKey( 7, $fields );
		$this->assertEquals( $fields[7], $formModel->getFields()->getField( 7 )->toArray() );
		$this->assertEquals( $fieldEntity7, $formModel->getFields()->getField( 7 ) );

		$this->assertArrayHasKey( 2, $fields );
		$this->assertEquals( $fields[2], $formModel->getFields()->getField( 2 )->toArray() );
		$this->assertEquals( $fieldEntity2, $formModel->getFields()->getField( 2 ) );

	}

    /**
     * Test adding a field to collection
     *
     * @covers Fields::addField()
     */
	public function testAddField()
	{
		$extraFieldArray = $this->fieldArrayFactory( 400 );
		$extraField = new \calderawp\interop\Entities\Field(  $extraFieldArray );
		$fieldsEntityCollection = $this->fieldEntityCollection( [10,20] );
		$fieldsEntityCollection->addField( $extraField );
		$this->assertEquals( $extraField, $fieldsEntityCollection->getField( 400 ) );


	}


}