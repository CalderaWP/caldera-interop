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

		$this->assertSame( $formArray[ 'fields' ], $formEntity->getFields() );

	}


	/**
	 * Test getting field by ID from fields collection
	 *
	 * @covers  \calderawp\interop\Entities\Form::setFields()
	 * @covers  \calderawp\interop\Entities\Form::getField()
	 */
	public function testGetField()
	{
		$formArray = $this->formArrayFactory( 42 );
		$formEntity = new \calderawp\interop\Entities\Form( $formArray );

		$this->assertSame( $formArray[ 'fields' ][4], $formEntity->getFieldById(4 )  );

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