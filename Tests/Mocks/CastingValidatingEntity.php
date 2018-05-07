<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Traits\CanCastAndValidateProps;

class CastingValidatingEntity extends Entity
{

    use CanCastAndValidateProps;

    protected $face;
	/** @var  int */
    protected $casts = [
        'face' => 'numeric',
    ];

	/**
	 * @param int $value
	 * @return bool
	 */
	protected function validateFace( $value )
	{

		return $value > 10 ? $value : 10;
	}




}