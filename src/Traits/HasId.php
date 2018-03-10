<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 10:39 PM
 */

namespace calderawp\interop\Traits;

trait HasId
{

	/**
	 * Item ID
	 *
	 * @var int
	 */
	private $id;

	/**
	 * Set item ID
	 *
	 * @param string|int $id
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Get item ID
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Fix 'ID' param
	 *
	 * @param array $data
	 * @return array
	 */
	protected static function fixId(array $data = array())
	{

		if (isset($data['id'])) {
			$data['ID'] = $data['id'];
		}

		return $data;
	}
}
