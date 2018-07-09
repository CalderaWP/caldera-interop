<?php


namespace calderawp\interop;
use calderawp\interop\Contracts\InteroperableEntity;
use calderawp\interop\Contracts\InteroperableTransformer;
use League\Fractal;

/**
 * Class Transformer
 * Generic Fractal Transformer that can be used for most cases
 */
class Transformer extends Fractal\TransformerAbstract implements InteroperableTransformer
{

    /** @inheritdoc */
    public function transform(InteroperableEntity $entity)
    {
        return $entity->toArray();
    }

}