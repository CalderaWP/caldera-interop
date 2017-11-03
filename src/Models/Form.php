<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 12:56 AM
 */

namespace calderawp\interop\Models;


use calderawp\interop\Collections\Fields;

class Form extends Model
{

	public static function fromArray( array  $form ){
		$defaults = array(
			'fields' => new Fields(),
			'processors' => null,
			'settings' => null,
			'conditionals'=> null
		);

		$obj = new static(
			array_keys( $defaults ),
			$defaults
		);


		foreach ( $form[ 'fields' ] as $field ){
			$obj->addField( Field::fromArray( $field ) );
		}

		return $obj;
	}

	public function addField( Field $field ){
		$this->getFields()->addField( $field );
	}

	/**
	 * @return Fields
	 */
	public function getFields()
	{
		return $this->get( 'fields' );
	}
}