<?php


namespace calderawp\interop\Mock;


use calderawp\interop\Traits\CanValidatePropertySet;

class ValidatingEntity extends Entity
{

    use CanValidatePropertySet;

    /** @var  array */
    protected $data;


    /**
     * @param array|\stdClass $data
     * @return array
     */
    protected function validateData( $data )
    {
        $data = $this->maybeCastObject($data);
        return [ 'hi' => is_array( $data ) && ! empty( $data[ 'hi' ] ) ? strip_tags( $data[ 'hi'] ) : 'roy' ];
    }


}