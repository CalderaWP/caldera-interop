<?php

namespace calderawp\interop\Models;

use calderawp\interop\Entities\Form as FormEntity;

class Form extends Model
{


	public static function fromArray( array $data ){
		self::fixId( $data );

		$entity = new FormEntity( $data );

		$obj = new static($entity  );
		$obj->setId( $data[ 'ID' ] );

		return $obj;

	}


}