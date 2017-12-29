<?php


namespace calderawp\interop\Traits;

/**
 *  Trait to allow entities or anything really to have validation callbacks when setting values.
 *
 *  Callback function is named validate{ucfirst($prop)} IE for property $data, add a protected method called validateData
 */
trait CanValidatePropertySet
{

    use  CanCastObjectToArray;

    /** @inheritdoc */
    public function __set($name, $value)
    {
        if( property_exists( $this, $name ) ){
            $validationCb = $this->getValidationCallbackName($name);
            if( is_callable( [ $this, $validationCb ]  ) ){
                $value = call_user_func( [ $this, $validationCb ], $value );
            }

            $this->$name = $value;
        }

    }

    /**
     * @param string $propName Property name
     * @return string Name of callback function
     */
    protected function getValidationCallbackName($propName)
    {
        $validationCb = 'validate' . ucfirst($propName);
        return $validationCb;
    }

}