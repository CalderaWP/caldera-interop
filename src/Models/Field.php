<?php

namespace calderawp\interop\Models;

/**
 * Class Field
 *
 *
 * @package calderawp\interop\Models
 */
class Field extends Model
{

	public static function fromArray( array $data ){
		$obj = new static( );
		$data = self::fixId($data);
		$obj->setId( $data[ 'ID' ] );

		return $obj;
	}




}