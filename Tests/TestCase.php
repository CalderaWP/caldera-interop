<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/2/17
 * Time: 11:20 PM
 */

abstract  class TestCase extends PHPUnit_Framework_TestCase
{

	/**
	 * @param $type
	 * @param int $id
	 * @return \calderawp\interop\Entities\Field|\calderawp\interop\Models\Model|__anonymous@500
	 */
	protected function entityFactory( $type, $id = 42 )
	{
		$field = $this->fieldArrayFactory($id);

		$form = $this->formArrayFactory($id);

		switch( ucwords( $type ) ){
			case 'FIELD':
				$entity = new \calderawp\interop\Entities\Field( $field );
				break;
			case 'FORM':
				$entity = new \calderawp\interop\Entities\Form(  $form );
				break;
			case 'GENERIC';
			default :
				$entity = new class( ) extends \calderawp\interop\Entities\Entity {
				    public function toArray()
                    {
                        return [];
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
		switch( ucwords( $type ) ){
			case 'FIELD':
			case 'FIELDS':
				$collection = $this->fieldEntityCollection();
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
	protected function fieldArrayFactory($id): array
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
	protected function formArrayFactory($id): array
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
}