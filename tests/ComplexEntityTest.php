<?php

namespace calderawp\interop\Tests;

use calderawp\caldera\Http\Response;
use calderawp\interop\Attribute;
use calderawp\interop\Collections\Attributes;
use calderawp\interop\ComplexEntity;
use calderawp\interop\Tests\Mocks\MockComplexEntity;

class ComplexEntityTest extends TestCase
{


	public function testFromArray()
	{
		$entity = MockComplexEntity::fromArray(['hats' => '1', 'bats' => 2]);
		$this->assertEquals('1', $entity->hats );
		$this->assertEquals([ 'hats' => '1'], $entity->toArray() );

	}

	public function testFromRestResponse()
	{
		$response = \Mockery::mock(Response::class);
		$data = [];
		$response->shouldReceive('getData')->andReturn(['hats' => '1', 'bats' => 2]);
		$name = 'hats';
		$attribute = new Attribute();
		$attribute->setName($name);
		$entity = MockComplexEntity::fromRestResponse($response);
		$this->assertEquals('1', $entity->hats );
		$this->assertEquals([ 'hats' => '1'], $entity->toArray() );
	}

	public function testToArray()
	{
		$name = 'hats';
		$attribute = new Attribute();
		$attribute->setName($name);
		$entity = new ComplexEntity();
		$entity->addAttribute($attribute);
		$entity->hats = '77hats';
		$this->assertSame([
			'hats' => '77hats',
		], $entity->toArray());

	}

	public function testGetAllowedProperties()
	{
		$name = 'hats';
		$attribute = new Attribute();
		$attribute->setName($name);
		$entity = new ComplexEntity();
		$entity->addAttribute($attribute);
		$this->assertTrue(in_array($name, $entity->getAllowedProperties()));

	}

	public function testAddAttribute()
	{
		$name = 'hats';
		$attribute = new Attribute();
		$attribute->setName($name);
		$entity = new ComplexEntity();
		$entity->addAttribute($attribute);
		$this->assertSame(1, $entity->getAttributes()->count());
	}

	public function testToRestResponse()
	{
		$name = 'hats';
		$attribute = new Attribute();
		$attribute->setName($name);
		$entity = new ComplexEntity();
		$entity->addAttribute($attribute);
		$entity->hats = '751';
		$headers = ['X-H' => 'h'];
		$response = $entity->toRestResponse(201, $headers);
		$this->assertEquals(201, $response->getStatus());
		$this->assertEquals($headers, $response->getHeaders());
		$this->assertEquals(['hats' => 751], $response->getData());
	}
}
