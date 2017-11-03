<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 11:20 PM
 */

abstract  class TestCase extends PHPUnit_Framework_TestCase
{

	/**
	 * @param $type
	 * @param int $id
	 * @return \calderawp\interop\Entities\Field|\calderawp\interop\Models\Model|__anonymous@500
	 */
	protected function entityFactory( $type, $id = 42 )
	{
		$field = array(
			'ID' => $id,
			'slug' => 'Noms',
			'config' => array(
				'option' => array()
			)
		);

		switch( ucwords( $type ) ){
			case 'Field':
				$entity = new \calderawp\interop\Entities\Field( $field );
				break;
			case 'Generic';
			default :
				$entity = new class( ) extends \calderawp\interop\Entities\Entity {};
				$entity->setId( $id );
				break;
		}

		return $entity;
	}
}