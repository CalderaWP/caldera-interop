<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Traits\CanCastProps;

class CastingEntity extends Entity
{

    use CanCastProps;


    protected $hi;
    protected  $title;
    protected $xp;
    protected $has;
    protected $otherhas;
    protected $casts = [
        'hi' => 'array',
        'title' => 'string',
        'xp' => 'numeric',
        'has' => 'bool',
        'otherhas' => 'boolean',
    ];




}