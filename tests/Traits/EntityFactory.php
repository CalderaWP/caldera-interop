<?php


namespace calderawp\interop\Tests\Traits;
use calderawp\interop\Contracts\CalderaForms\HasField;
use calderawp\interop\Contracts\CalderaForms\HasFields;
use calderawp\interop\Contracts\CalderaForms\HasForm;
use calderawp\interop\Contracts\CalderaForms\HasForms;
use calderawp\interop\Contracts\HasSetting;
use calderawp\interop\Contracts\HasSettings;


trait EntityFactory
{

	public function getField() :HasField
	{
		return \Mockery::mock( 'Field', HasField::class );
	}

	public function getFields() :HasFields
	{
		return \Mockery::mock( 'Fields', HasFields::class );
	}

	public function getForm() :HasForm
	{
		return \Mockery::mock( 'Form', HasForm::class );
	}

	public function getForms() :HasForms
	{
		return \Mockery::mock( 'Forms', HasForms::class );
	}

	public function getSetting() : HasSetting
	{
		return \Mockery::mock( 'Setting', HasSetting::class );

	}

	public function getSettings() : HasSettings
	{
		return \Mockery::mock( 'Settings', HasSettings::class );

	}

	protected function createFormId(): string
	{
		return uniqid('cf');
	}
}
