<?php

class FieldEntityTest extends EntityTestCase
{

	/**
	 * Test getting and setting from array
	 *
	 * @requires PHP 7.0
	 *
	 * @covers \calderawp\interop\Entities\Field::toArray()
	 * @covers \calderawp\interop\Entities\Field::fromArray()
	 */
	public function testToArray(){

		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
			'config' => array(
				'option' => array()
			)
		);

		$entity = new class( array( 'ID' => 42 ) ) extends \calderawp\interop\Entities\Field {
			public function __construct(array $field)
			{
					parent::__construct($field);
					$this->field = array(
						'ID' => 42,
						'slug' => 'Noms',
						'config' => array(
							'option' => array()
						)
				)	;
			}
		};

		$this->assertSame( $field, $entity->toArray() );
	}

	/**
	 * Test getting and setting from array
	 *
	 * @covers \calderawp\interop\Entities\Field::toArray()
	 * @covers \calderawp\interop\Entities\Field::fromArray()
	 */
	public function testFromToArray(){

		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
			'config' => array(
				'option' => array()
			)
		);

		$entity = new \calderawp\interop\Entities\Field( $field );
		$this->assertSame( $field, $entity->toArray() );

	}

	/**
	 * Test getting config array key
	 *
	 * @covers \calderawp\interop\Entities\Field::getConfigKey()
	 */
	public function testGetConfigKey()
	{

		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
			'config' => array(
				'option' => array()
			)
		);

		$entity = new \calderawp\interop\Entities\Field( $field );
		$this->assertSame( $field[ 'config' ], $entity->getConfigKey() );

		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
		);

		$entity = new \calderawp\interop\Entities\Field( $field );
		$this->assertSame( array(), $entity->getConfigKey() );
	}

	/**
	 * Test getting slug array key
	 *
	 * @covers \calderawp\interop\Entities\Field::getConfigKey()
	 */
	public function testGetSlug()
	{
		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
		);

		$entity = new \calderawp\interop\Entities\Field( $field );
		$this->assertSame( $field[ 'slug' ], $entity->getSlug() );

	}

	/**
	 * Test getting other field key
	 *
	 * @covers \calderawp\interop\Entities\Field::fieldKey()
	 */
	public function testGetFieldKeyOther()
	{
		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
			'other' => 'Other'
		);

		$entity = new \calderawp\interop\Entities\Field( $field );
		$this->assertSame( $field[ 'other' ], $entity->fieldKey( 'other') );
	}

	/**
	 * Test getting other field key default
	 *
	 * @covers \calderawp\interop\Entities\Field::fieldKey()
	 */
	public function testGetFieldKeyOtherDefault()
	{
		$field = array(
			'ID' => 42,
			'slug' => 'Noms',
			'other' => 'Other'
		);

		$entity = new \calderawp\interop\Entities\Field( $field );
		$this->assertSame( 'Roy', $entity->fieldKey( 'roy', 'Hi' ) );
		$this->assertSame( array( 'Hi' => 'Roy' ), $entity->fieldKey( array( 'Hi' => 'Roy' ) ) );
	}




}