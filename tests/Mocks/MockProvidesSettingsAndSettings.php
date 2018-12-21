<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\HasSettings;
use calderawp\interop\Contracts\HasSetting;
use calderawp\interop\Traits\ProvidesSetting;
use calderawp\interop\Traits\ProvidesSettings;


class MockProvidesSettingsAndSettings extends MockCaldera implements HasSettings,HasSetting
{
		use ProvidesSettings,ProvidesSetting;

}
