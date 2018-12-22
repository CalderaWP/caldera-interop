<?php


namespace calderawp\interop\Contracts\WordPress;

interface ApplysFilters
{

	/**
	 * Add a filter
	 *
	 * @param string $filterName
	 * @param callable $callback
	 * @param int $priority
	 * @param int $args
	 *
	 * @return mixed
	 */
	public function addFilter(string $filterName, callable  $callback, int $priority = 20, $args = 1);

	/**
	 * Apply a filter
	 *
	 * @param string $filterName
	 * @param mixed ...$args
	 *
	 * @return mixed
	 */
	public function applyFilters(string $filterName, ...$args);
}
