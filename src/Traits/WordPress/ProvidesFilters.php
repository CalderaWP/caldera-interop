<?php


namespace calderawp\interop\Traits\WordPress;

trait ProvidesFilters
{

	protected $filters = [];

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
	public function addFilter(string $filterName, callable  $callback, int $priority = 20, $args = 1)
	{
		$this->filters[$filterName][$priority][] = [$callback,$args];
	}

	/**
	 * @param string $filterName
	 * @param mixed ...$args
	 *
	 * @return mixed|null
	 */
	public function applyFilters(string $filterName, ...$args)
	{
		$filters = isset($this->filters[$filterName]) ? $this->filters[$filterName] : null;
		$value = isset($args[0]) ? $args[0] : null;
		if (! $filters) {
			return $value;
		}


		ksort($filters);
		foreach ($filters as $priority => $_filters) {
			foreach ($_filters as $filter) {
				$callback = $filter[0];
				$numArgs = is_numeric($filter[1]) ? (int)$filter[1] : 1;
				if (1 === $numArgs) {
					$value =  call_user_func($callback, $value);
				} elseif ($numArgs === count($args)) {
					$value = call_user_func_array($callback, $args);
				} else {
					$value = call_user_func_array($callback, array_slice($args, 0, $numArgs));
				}
			}
		}

		return $value;
	}
}
