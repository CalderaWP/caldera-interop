<?php


namespace calderawp\interop\Traits;

/**
 *  Trait to allow entities or anything really to have validation callbacks when setting values.
 *
 *  Callback function is named validate{ucfirst($prop)} IE for property $data, add a protected method called validateData
 */
trait CanValidatePropertySet
{

    /** @inheritdoc */
    public function __set($name, $value)
    {
        if( property_exists( $this, $name ) ){
            $validationCb = 'validate' . ucfirst( $name );
            if( is_callable( [ $this, $validationCb ]  ) ){
                $value = call_user_func( [ $this, $validationCb ], $value );
            }

            $this->$name = $value;
        }

    }

    /**
     * Cast stdClass to array and leave array and array
     *
     * @param array|\stdClass $data
     * @return array
     */
    protected function maybeCastObject($data)
    {

        if (is_object($data) && is_a($data, '\stdClass')) {
            $data = (array)$data;

        }

        return $data;
    }

}