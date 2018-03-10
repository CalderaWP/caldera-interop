<?php

namespace calderawp\interop\Models;

use \calderawp\interop\Entities\Field as FieldEntity;

/**
 * Class Field
 *
 *
 * @package calderawp\interop\Models
 */
class Field extends Model
{

	public static function fromArray(array $data)
	{
		self::fixId($data);

		$entity = new FieldEntity($data);

		$obj = new static($entity);
		$obj->setId($data[ 'ID' ]);

		return $obj;
	}
}
