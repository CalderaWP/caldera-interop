<?php


namespace calderawp\interop\Interfaces;

interface CollectsEntities
{
	/**
	 * Get name of setter function for adding items to collection
	 *
	 * @return string
	 */
	public function getEntitySetter();
	/**
	 * Get name of getter function for adding items to collection
	 *
	 * @return string
	 */
	public function getEntityGetter();
}
