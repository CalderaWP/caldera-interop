<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 12:54 AM
 */

namespace calderawp\interop\Models;


class Field extends Model
{


	public static function fromArray( array $field ){
		return new static( );
	}

	public function id(){
		return 0;
	}
}