<?php


namespace calderawp\interop\Contracts;

/**
 * Interface InteroperableTransformer
 *
 * Interface that any class that is used to apply a Fractal Transformer MUST implement.
 */
interface InteroperableTransformer
{
    /**
     * Transform an interoperable entity using Fractal transformer
     *
     * @see https://fractal.thephpleague.com/transformers/
     *
     * @param InteroperableEntity $entity Interoperable entity to transform
     * @return array
     */
    public function transform( InteroperableEntity $entity );

}