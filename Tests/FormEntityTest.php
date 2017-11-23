<?php


class FormEntityTest extends EntityTestCase
{

	/**
	 * Test getting fields from fields collection
	 *
	 * @covers  \calderawp\interop\Entities\Form::setFields()
	 * @covers  \calderawp\interop\Entities\Form::getFields()
	 */
	public function testGetFields()
	{
		$formArray = $this->formArrayFactory( 42 );
		$formEntity = new \calderawp\interop\Entities\Form( $formArray );

		$entityFields = $formEntity->getFields()->toArray();
		foreach ( $formArray[ 'fields' ]  as $id => $field ){
		    $this->assertArrayHasKey( $id, $entityFields );
            $this->assertSame( $field, $entityFields[ $id ] );

        }

	}


	/**
	 * Test getting field by ID from fields collection
	 *
	 * @covers  \calderawp\interop\Entities\Form::setFields()
	 * @covers  \calderawp\interop\Entities\Form::getField()
	 */
	public function testGetField()
	{
		$formArray = $this->formArrayFactory( 'Cf12345' );
		$formEntity = new \calderawp\interop\Entities\Form( $formArray );
        foreach ( $formArray[ 'fields' ] as $id => $field ){
            $_field = $formEntity->getFieldById( $id );
            $this->assertNotNull( $_field );
            $this->assertSame( $id, $_field->getId() );
            $this->assertSame( $field, $_field->toArray() );
        }


	}

	/**
	 * Test getting form name
	 *
	 * @covers  \calderawp\interop\Entities\Form::setFields()
	 * @covers  \calderawp\interop\Entities\Form::getField()
	 */
	public function testGetName()
	{
		$name = 'Roy R3S Sivan';
		$formArray = $this->formArrayFactory( 42 );
		$formArray[ 'name' ] = $name;

		$formEntity = new \calderawp\interop\Entities\Form( $formArray );
		$this->assertEquals( $name, $formEntity->getName() );
	}
}