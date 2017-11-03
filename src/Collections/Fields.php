<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 1:21 AM
 */

namespace calderawp\interop\Collections;

use \calderawp\interop\Models\Field;

class Fields extends Collection
{

	private $fields;

	public function addField( Field $field ){
		$this->fields[ $field->id() ] = $field;
		return $this;
	}

	public function hasField( $id ){
		return array_key_exists( $id, $this->fields );
	}
}