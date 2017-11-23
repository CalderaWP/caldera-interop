<?php


namespace calderawp\interop\Entities\Entry;


use calderawp\interop\Entities\Entity;

/**
 * Class Details
 *
 * Object representation of entry details. In Caldera Forms, this is stored in $prefix_cf_form_entries table
 *
 * @package calderawp\interop\Entities\Entry
 */
class Details extends Entity
{

    /** @var  string */
    protected $form_id;

    /** @var  int */
    protected $user_id;

    /** @var  string */
    protected $datestamp;

    /** @var  string */
    protected $status;

}