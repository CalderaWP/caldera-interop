<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Traits\CanCastAndValidateProps;
use calderawp\interop\Traits\HasId;

class CastingValidatingEntity extends Entity
{

    use CanCastAndValidateProps, HasId;

    protected $face;
	/** @var  int */
    protected $casts = [
        'face' => 'numeric',
		'id' => 'string'
    ];

	/**
	 * @param int $value
	 * @return bool
	 */
	protected function validateFace( $value )
	{

		return $value > 10 ? $value : 10;
	}

	public function toArray()
	{
		return array_merge( [ 'id' => $this->getId()], parent::toArray() );
	}




}