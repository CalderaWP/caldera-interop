<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface CreateFromStdClass
 *
 * Interface for objects that can be created from stdClass MUST impliment
 *
 * @package calderawp\interop\Interfaces
 */
interface CreateFromStdClass
{
    /**
     * Create form stdClass
     *
     * @param $data
     * @return static
     */
    public static function fromStdClass($data);

}