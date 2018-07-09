<?php


namespace calderawp\interop;


use calderawp\interop\Contracts\InteroperableCollection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Collection
 *
 * A generic collection that can be used in most cases
 */
class Collection extends ArrayCollection implements InteroperableCollection
{

}