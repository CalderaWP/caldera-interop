<?php


namespace calderawp\interop\Traits;


trait CanRecursivelyCastArray
{

    /**
     * Recursively cast object to array
     *
     * @param \stdClass|array $array
     * @return array
     */
    protected static function arrayCastRecursiveStatic($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::arrayCastRecursiveStatic($value);
                }
                if ($value instanceof \stdClass) {
                    $array[$key] = self::arrayCastRecursiveStatic((array)$value);
                }
            }
        }
        if ($array instanceof \stdClass) {
            return self::arrayCastRecursiveStatic((array)$array);
        }
        return (array)$array;
    }

    /**
     * Recursively cast object to array
     *
     * @param \stdClass|array $array
     * @return array
     */
    protected function arrayCastRecursive($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = $this->arrayCastRecursive($value);
                }
                if ($value instanceof \stdClass) {
                    $array[$key] = $this->arrayCastRecursive((array)$value);
                }
            }
        }
        if ($array instanceof \stdClass) {
            return $this->arrayCastRecursive((array)$array);
        }
        return (array)$array;
    }

}