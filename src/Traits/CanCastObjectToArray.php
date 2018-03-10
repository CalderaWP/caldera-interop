<?php


namespace calderawp\interop\Traits;


trait CanCastObjectToArray
{

    /**
     * Cast stdClass to array and leave array and array
     *
     * @param  array|\stdClass $data
     * @return array
     */
    protected function maybeCastObject($data)
    {
        if (is_object($data)) {
            $data = (array)$data;

        }


        return $data;
    }
}