<?php

abstract  class CalderaInteropTestCase extends PHPUnit_Framework_TestCase
{

	/**
	 * @param $type
	 * @param int $id
	 * @return \calderawp\interop\Entities\Entity
	 */
	protected function entityFactory( $type, $id = 42 )
	{
		$field = $this->fieldArrayFactory($id);

		$form = $this->formArrayFactory($id);
		switch(  $type  ){
			case \calderawp\interop\CalderaForms::FIELD:
			case 'FIELD':
				$entity = new \calderawp\interop\Entities\Field( $field );
				break;
			case \calderawp\interop\CalderaForms::FORM:
			case 'FORM':
				$entity = new \calderawp\interop\Entities\Form( $form );
				break;
			case \calderawp\interop\CalderaForms::ENTRY:
			case 'ENTRY' :
                $entity = new \calderawp\interop\Entities\Entry(
                    $this->entityFactory( 'ENTRY_DETAILS', 40 ),
                    new \calderawp\interop\Collections\EntityCollections\EntryValues\Fields(
                        [
                            $this->entityFactory( 'ENTRY_VALUE', 40 ),
                            $this->entityFactory( 'ENTRY_VALUE', 41 ),
                            $this->entityFactory( 'ENTRY_VALUE', 42 )
                        ]
                    ),
                    new \calderawp\interop\Entities\Form( $form )
                );
                break;
            case 'ENTRY_DETAILS' :
                $entity = \calderawp\interop\Entities\Entry\Details::fromArray(
                    [
                        'id' => $id,
                        'form_id' => 'cf12345',
                        'user_id' => 1,
                        'datestamp' => '11:42:01',
                        'status' => 'active'
                    ]
                );
                break;
			case \calderawp\interop\CalderaForms::ENTRY_VALUE:
			case 'ENTRY_FIELD' :
            case 'ENTRY_VALUE' :
                $entity = \calderawp\interop\Entities\Entry\Field::fromArray(
                    [
                        'entry_id' => $id,
                        'field_id' => 'fld' . rand(),
                        'slug' => random_bytes( 42 ),
                        'value' => random_bytes( 42 )
                    ]
                );
                break;
			case 'GENERIC';
			default :
				$entity = new class( ) extends \calderawp\interop\Entities\Entity {
				    public function toArray()
                    {
                        return [];
                    }

                    public static function getType()
					{
						return 'GENERIC';
					}
				};
				break;
		}

        $entity->setId( $id );

		return $entity;
	}

	/**
	 * @param $type
	 * @return \calderawp\interop\Collections\EntityCollections\EntityCollection|\calderawp\interop\Collections\EntityCollections\Fields|__anonymous@1205
	 */
	protected function entityCollectionFactory( $type )
	{
		switch( strtoupper( $type ) ){
			case 'FIELD':
			case 'FIELDS':
				$collection = $this->fieldEntityCollection();
				break;
            case 'ENTRY_VALUES' :
            case 'ENTRY_FIELDS' :
                $collection = new \calderawp\interop\Collections\EntityCollections\EntryValues\Fields(
                    [
                        $this->entityFactory( 'ENTRY_FIELD', rand() ),
                        $this->entityFactory( 'ENTRY_FIELD', rand() ),
                        $this->entityFactory( 'ENTRY_FIELD', rand() ),
                        $this->entityFactory( 'ENTRY_FIELD', rand() ),

                    ]
                );
                break;
			case 'FORM':
			case 'FORMS':
			case 'GENERIC';
			default :
				$collection = new class( ) extends \calderawp\interop\Collections\EntityCollections\EntityCollection {
					public function toArray()
					{
						return [];
					}
				};
				break;
		}

		return $collection;
	}


	/**
	 * @param array $ids
	 * @return \calderawp\interop\Collections\EntityCollections\Fields
	 */
	protected function fieldEntityCollection( $ids = [ 4, 8 ] ){
		$fields = [];
		foreach ( $ids as $id ){
			$fields[] = $this->entityFactory( 'FIELD', $id );

		}

		return new \calderawp\interop\Collections\EntityCollections\Fields( $fields );
	}

	/**
	 * @param $id
	 * @return array
	 */
	protected function fieldArrayFactory($id)
	{
		$field = array(
			'ID' => $id,
			'slug' => 'Noms',
			'config' => array(
				'option' => array()
			)
		);
		return $field;
	}

	/**
	 * @param $id
	 * @return array
	 */
	protected function formArrayFactory($id)
	{
		$form = array(
			'ID' => $id,
			'name' => 'Noms',
			'fields' => array(
				24 => $this->fieldArrayFactory(24),
				22 => $this->fieldArrayFactory(22),
			)
		);
		return $form;
	}

	/**
	 * @return \calderawp\interop\CalderaForms
	 */
	protected function createApp()
	{
		$interopContainer = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($interopContainer);
		$serviceContainer = new \calderawp\CalderaContainers\Service\Container();
		$calderaForms = new \calderawp\interop\CalderaForms($factory, $serviceContainer);
		return $calderaForms;
	}


}