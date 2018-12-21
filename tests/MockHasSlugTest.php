<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockHasSlug;

class MockHasSlugTest extends TestCase
{
	/**
	 * @covers \calderawp\interop\Traits\ProvidesSlug::setSlug()
	 * @covers \calderawp\interop\Traits\ProvidesSlug::getSlug()
	 */
	public function testGetSlug()
	{
		$slug = new MockHasSlug();
		$_slug = 'vroom';
		$slug->setSlug($_slug );
		$this->assertEquals($_slug,$slug->getSlug());


	}

	/**
	 * @covers \calderawp\interop\Traits\ProvidesSlug::setSlug()
	 */
	public function testSetSlug()
	{
		$slug = new MockHasSlug();
		$_slug = 'vroom';
		$slug->setSlug($_slug );
		$this->assertAttributeEquals($_slug,'slug',$slug);
	}
}
