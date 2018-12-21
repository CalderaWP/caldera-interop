<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesSettingsAndSettings;
use calderawp\interop\Contracts\HasSetting;
use calderawp\interop\Contracts\HasSettings;

class MockProvidesSettingsAndSettingsTest extends TestCase
{
	/**
	 * @covers \calderawp\interop\Traits\ProvidesSetting::setSetting();
	 */
	public function testSetSetting()
	{
		$model = new MockProvidesSettingsAndSettings();
		$setting = \Mockery::mock( 'Setting', HasSetting::class );
		$model->setSetting($setting);
		$this->assertAttributeEquals($setting, 'setting', $model );
	}
	/**
	 * @covers \calderawp\interop\Traits\ProvidesSettings::getSettings();
	 */
	public function testGetSettings()
	{
		$model = new MockProvidesSettingsAndSettings();
		$settings = \Mockery::mock( 'Settings', HasSettings::class );
		$model->setSettings($settings);
		$this->assertEquals($settings, $model->getSettings() );
	}
	/**
	 * @covers \calderawp\interop\Traits\ProvidesSettings::setSettings();
	 */
	public function testSetSettings()
	{
		$model = new MockProvidesSettingsAndSettings();
		$settings = \Mockery::mock( 'Settings', HasSettings::class );
		$model->setSettings($settings);
		$this->assertAttributeEquals($settings, 'settings', $model );
	}
	/**
	 * @covers \calderawp\interop\Traits\ProvidesSetting::setSetting();
	 */
	public function testGetSetting()
	{
		$model = new MockProvidesSettingsAndSettings();
		$settings = \Mockery::mock( 'Setting', HasSetting::class );
		$model->setSetting($settings);
		$this->assertEquals($settings,  $model->getSetting() );
	}
}
