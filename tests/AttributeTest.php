<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Attribute;

class AttributeTest extends TestCase
{

	public function testFromArray()
	{

		$validate = function (){};
		$sanitize = function (){};
		$data = [
			'name' => 'the-name',
			'description' => 'the description',
			'sqlDescriptor' => 'int(11) unsigned NOT NULL AUTO_INCREMENT ',
			'validateCallback' => $validate,
			'sanitizeCallback' => $sanitize,
			'dataType' => 'integer',
			'format' => '%d'

		];
		$attribute = Attribute::fromArray($data);
		$this->assertEquals($data['name'],$attribute->getName());
		$this->assertEquals($data['description'],$attribute->getDescription());
		$this->assertEquals($data['dataType'],$attribute->getDataType());
		$this->assertEquals($data['sqlDescriptor'],$attribute->getSqlDescriptor());
		$this->assertEquals($data['validateCallback'],$attribute->getValidateCallback());
		$this->assertEquals($data['sanitizeCallback'],$attribute->getSanitizeCallback());
		$this->assertEquals($data['format'],$attribute->getFormat());

	}

	public function testFromArrayNoOptionalKeys()
	{


		$data = [
			'name' => 'the-name',
			'description' => 'the description',

		];
		$attribute = Attribute::fromArray($data);
		$this->assertEquals($data['name'],$attribute->getName());
		$this->assertEquals($data['description'],$attribute->getDescription());
		$this->assertNull($attribute->getValidateCallback());
		$this->assertNull($attribute->getSanitizeCallback());
		$this->assertEquals('%s', $attribute->getFormat());
		$this->assertEquals('string', $attribute->getDataType());


	}

	public function testToArray()
	{
		$validate = function (){};
		$sanitize = function (){};
		$data = [
			'name' => 'the-name',
			'description' => 'the description',
			'sqlDescriptor' => 'int(11) unsigned NOT NULL AUTO_INCREMENT ',
			'validateCallback' => $validate,
			'sanitizeCallback' => $sanitize,
			'dataType' => 'integer',
			'format' => '%d'
		];
		$attribute = Attribute::fromArray($data);
		$this->assertEquals($data,$attribute->toArray());
	}


	public function testToArrayNoDefaults()
	{
		$data = [
			'name' => 'the-name',
			'description' => 'the description',
		];
		$expect = [
			'name' => 'the-name',
			'description' => 'the description',
			'sqlDescriptor' => '',
			'validateCallback' => null,
			'sanitizeCallback' => null,
			'dataType' => 'string',
			'format' => '%s'
		];
		$attribute = Attribute::fromArray($data);
		$this->assertEquals($expect,$attribute->toArray());
	}
}
