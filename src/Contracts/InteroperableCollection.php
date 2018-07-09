<?php


namespace calderawp\interop\Contracts;


use Doctrine\Common\Collections\Collection;

/**
 * Interface InteroperableCollection
 *
 * Interface that all collections of Interoperable entities or models MUST implement
 *
 * Enforces that our collections are Doctrine Collections
 * @see https://www.doctrine-project.org/projects/doctrine-collections/en/latest/index.html
 */
interface InteroperableCollection extends Collection
{

}