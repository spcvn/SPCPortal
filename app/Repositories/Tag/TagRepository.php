<?php

namespace SPCVN\Repositories\Tag;

use SPCVN\Tag;

interface TagRepository
{
    /**
     * Get all system tags.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Lists all system tags into $key => $column value pairs.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'name', $key = 'id');

    /**
     * Find system tag by id.
     *
     * @param $id Tag Id
     * @return Tag|null
     */
    public function findById($id);

    /**
     * Find tag by name:
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * Create new system tag.
     *
     * @param array $data
     * @return Tag
     */
    public function create(array $data);

    /**
     * Update specified tag.
     *
     * @param $id Tag Id
     * @param array $data
     * @return Tag
     */
    public function update($id, array $data);

    /**
     * Remove tag from repository.
     *
     * @param $id Tag Id
     * @return bool
     */
    public function delete($id);
}
