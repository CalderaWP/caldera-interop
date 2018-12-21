<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\Interoperable;
use calderawp\interop\Contracts\RestRequestContract;
use calderawp\interop\Contracts\RestResponseContract;
use calderawp\interop\Traits\CreatesInteropModelFromArray;

class MockInteroperable implements Interoperable
{
	use CreatesInteropModelFromArray;

	/**
	 * @inheritDoc
	 */
	public static function fromRequest(RestRequestContract $request): Interoperable
	{
		// TODO: Implement fromRequest() method.
	}

	/**
	 * @inheritDoc
	 */
	public function toResponse(): RestResponseContract
	{
		// TODO: Implement toResponse() method.
	}

	/**
	 * @inheritDoc
	 */
	public function toArray(): array
	{
		// TODO: Implement toArray() method.
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}
}
