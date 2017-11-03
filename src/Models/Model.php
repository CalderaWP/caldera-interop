<?php

namespace calderawp\interop\Models;



use calderawp\interop\Container;

abstract class Model extends Container
{

	/**
	 * Item ID
	 *
	 * @var int
	 */
	protected $id;

	/**
	 * @param $id
	 */
	public function setId( $id )
	{
		$this->id = $id;
	}

	/**
	 * Set item ID
	 *
	 * @return int
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Fix 'ID' param
	 *
	 * @param array $data
	 * @return array
	 */
	protected static function fixId( array $data )
	{
		if (isset($data['id']) && !isset($data['ID'])) {
			$data['ID'] = $data['id'];
		}

		return $data;
	}
}