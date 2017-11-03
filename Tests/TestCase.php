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
		$field = $this->fieldArrayFactory($id);

		$form = $this->formArrayFactory($id);

		switch( ucwords( $type ) ){
			case 'Field':
				$entity = new \calderawp\interop\Entities\Field( $field );
				break;
			case 'Form':
				$entity = new \calderawp\interop\Entities\Form(  $form );
			case 'Generic';
			default :
				$entity = new class( ) extends \calderawp\interop\Entities\Entity {};
				$entity->setId( $id );
				break;
		}

		return $entity;
	}

	/**
	 * @param $id
	 * @return array
	 */
	protected function fieldArrayFactory($id): array
	{
		$field = array(
			'ID' => $id,
			'slug' => 'Noms',
			'config' => array(
				'option' => array()
			)
		);
		return $field;
	}

	/**
	 * @param $id
	 * @return array
	 */
	protected function formArrayFactory($id): array
	{
		$form = array(
			'ID' => $id,
			'name' => 'Noms',
			'fields' => array(
				24 => $this->fieldArrayFactory(24),
				22 => $this->fieldArrayFactory(22),
			)
		);
		return $form;
	}
}