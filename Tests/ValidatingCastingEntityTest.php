<?php


class ValidatingCastingEntityTest extends CalderaInteropTestCase
{

	/**
	 * Test that casting casts
	 *
	 * @covers  CanCastAndValidateProps::__set()
	 */
	public function testCast()
	{

		$entity = new \calderawp\interop\Mock\CastingValidatingEntity();
		$entity->face = '50';
		$this->assertSame( 50, $entity->face );
		$this->assertEquals( 'integer', getType($entity->face) );
	}


	/**
	 * Test that validation validates
	 *
	 * @covers  CanCastAndValidateProps::__set()
	 */
	public function testValidation()
	{

		$entity = new \calderawp\interop\Mock\CastingValidatingEntity();
		$entity->face = -50;
		$this->assertSame( 10, $entity->face );
		$this->assertEquals( 'integer', getType($entity->face) );
	}


	/**
	 *
	 * @group now
	 */
	public function testDefaults()
	{

		$entity = new \calderawp\interop\Mock\CastingValidatingEntity();
		$array = $entity->toArray();
		$this->assertArrayHasKey( 'face', $array );
		$this->assertArrayHasKey( 'id', $array );
		$this->assertEquals( 10, $array[ 'face' ] );
		$this->assertEquals( 10, $entity->face );

	}

}