<?php

class StackTest extends PHPUnit_Framework_TestCase
{
	public function testPushAndPop()
	{
		$field = new \calderawp\interop\Models\Field();
		$field->setId( 42 );
		$this->assertEquals( 42, $field->getId() );
	}
}