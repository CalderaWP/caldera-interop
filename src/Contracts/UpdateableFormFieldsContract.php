<?php


namespace calderawp\interop\Contracts;


interface UpdateableFormFieldsContract
{

	public function setFieldUpdater( callable  $fieldUpdater ) : UpdateableFormFieldsContract;
	public function getFields() : array;
	public function updateFieldValue( string $fieldId, $newValue );
	public function getFieldValue(string $fieldId,$default = null);
	public function hasField(string  $fieldId ): bool;
}
