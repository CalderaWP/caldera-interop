<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockFilters;
use calderawp\interop\Traits\WordPress\ProvidesFilters;
use PHPUnit\Framework\TestCase;

class MockFiltersTest extends TestCase
{
	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::addFilter()
	 */
	public function testAddFilter()
	{
		$filters = new MockFilters();
		$callback = function () {};
		$filters->addFilter('the_content', $callback, 20, 4);
		$this->assertAttributeEquals([
			'the_content' =>
				[
					20 =>
						[

							[
								$callback,
								4,
							],
						],
				],
		], 'filters', $filters);

	}
	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::applyFilters()
	 */
	public function testApplyFilters()
	{
		$filters = new MockFilters();
		$callback = function ($content) {
			return 'Hi Roy';
		};
		$filters->addFilter('the_content', $callback, 20, 1);
		$content = $filters->applyFilters('the_content', 'Roy' );
		$this->assertEquals('Hi Roy', $content);
	}
	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::applyFilters()
	 */
	public function testApplyFiltersPassesValue()
	{
		$filters = new MockFilters();
		$callback = function ($content) {
			return $content . '2';
		};
		$filters->addFilter('the_content', $callback, 20, 1);
		$content = $filters->applyFilters('the_content', 'Roy' );
		$this->assertEquals('Roy2', $content);
	}

	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::applyFilters()
	 */
	public function testApplyFiltersNoCallback()
	{
		$filters = new MockFilters();
		$content = $filters->applyFilters('the_content', 'Roy' );
		$this->assertEquals('Roy', $content);
	}


	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::applyFilters()
	 */
	public function testApplyFiltersRespectsPriority()
	{
		$filters = new MockFilters();
		$callbackFirst = function ($content) {
			return $content . '1';
		};

		$callbackSecond = function ($content) {
			return $content . '2';
		};
		$filters->addFilter('the_content', $callbackSecond, 25, 1);
		$filters->addFilter('the_content', $callbackFirst, 10, 1);
		$content = $filters->applyFilters('the_content', 'Roy' );
		$this->assertEquals('Roy12', $content);
	}

	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::applyFilters()
	 */
	public function testApplyFiltersMultipleArgs()
	{
		$filters = new MockFilters();
		$callback = function ($content, $also) {
			return $content . '3' . $also;
		};


		$filters->addFilter('the_content', $callback, 25, 2);
		$content = 'Roy';
		$also = 'Sivan';
		$result  = $filters->applyFilters('the_content', 'Roy', $also  );
		$this->assertEquals($callback($content,$also), $result);
	}

	/**
	 * @covers \calderawp\interop\Traits\WordPress\ProvidesFilters::applyFilters()
	 */
	public function testApplyFiltersMultipleArgsButNotAll()
	{
		$filters = new MockFilters();
		$callback = function ($content, $also) {
			return $content . '3' . $also;
		};

		$filters->addFilter('the_content', $callback, 25, 2);
		$content = 'Roy';
		$also = 'Sivan';
		$result  = $filters->applyFilters('the_content', 'Roy', $also, 'randomExtra'  );
		$this->assertEquals($callback($content,$also), $result);
	}
}
