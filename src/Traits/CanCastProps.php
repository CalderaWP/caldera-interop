<?php


namespace calderawp\interop\Traits;



use calderawp\interop\Exceptions\Exception;

trait CanCastProps
{
    use  CanCastObjectToArray;

    /** @inheritdoc */
    public function __set($name, $value)
    {
        if( property_exists( $this, $name ) ){

            if( $this->hasCast($name)){
                $this->applyCast($name,$value);
            }else{
                $this->$name = $value;
            }

        }

    }

    /**
     * @param string $propName Property name
     * @return bool
     */
    private function hasCast($propName)
    {
        return array_key_exists( $propName, $this->casts);
    }

    /**
     * @param string $propName Property name
     * @param mixed $value Value to set
     * @throws Exception Thrown if cast callback not callable
     */
    private function applyCast($propName,$value)
    {
        $callable = [ $this, $this->castCallback($this->casts[$propName])];
        if( ! is_callable( $callable ) ){
            throw new Exception( json_encode($callable));
        }
        $this->$propName = call_user_func( $callable,$value);
    }

    /**
     * @param string $type Type of cast callback to get
     * @return string
     */
    private function castCallback($type)
    {
        return 'cast' . ucfirst( $type);
    }

    /**
     * Cast to array if needed
     *
     * @param array|\stdClass|mixed $data
     * @param $string $default Optional. Default value. Default default is empty array
     * @return array
     */
    private function castArray($data,$default=[])
    {
        $data = $this->maybeCastObject($data);

        return is_array( $data ) ? $data : $default;
    }

    /**
     * @param string|mixed $string
     * @param $string $default Optional. Default value. Default default is empty string
     * @return string
     */
    private function castString($string,$default='')
    {
        return is_string( $string ) ? $string : $default;
    }


}