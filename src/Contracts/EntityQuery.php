<?php

namespace calderawp\interop\Contracts;

/**
 * Interface EntityQuery
 *
 * Interface that objects that handle select|deleting/etc. entities MUST implement
 */
interface EntityQuery
{
    /**
     * Find an entity in the database by ID
     *
     * @param string|integer $id Id of entity to find
     * @return InteroperableEntity|null
     */
    public function find($id);
    /**
     *
     *
     * @param string $field Column to search in
     * @param string|integer $value Value to search by
     * @return array
     */
    public function findWhere($field,$value);
    /**
     * Create a new entity in the database
     *
     * @param InteroperableEntity $entity Entity to save
     * @return InteroperableEntity|null
     */
    public function create(InteroperableEntity $entity );
    /**
     * Find an entity in the database by ID
     *
     * @param string|integer $id Id of entity to find
     * @return InteroperableEntity|null
     */
    public function read($id);
    /**
     * Update an entity in the database
     *
     * @param InteroperableEntity $entity Entity to save
     * @return InteroperableEntity|null
     */
    public function update(InteroperableEntity $entity );
    /**
     * Update an entity in the database
     *
     * @param string|integer $id Id of entity to delete
     * @return InteroperableEntity|null
     */
    public function delete($id);

}