<?php


namespace calderawp\interop\Contracts\WordPress;

interface Wpdb
{
	// phpcs:disable
	public function prepare( $query, $args );
	public function get_results( $query = null, $output = OBJECT );
	// phpcs:enable

}
