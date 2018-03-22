<?php


namespace calderawp\interop\Providers;

class ServiceFactory
{

	/**
	 * @var EntityProvider
	 */
	protected $entityProvider;


	public function __construct(EntityProvider $entityProvider)
	{
	}

	public function getEntity($type, array $args = [])
	{
	}
}
