<?php

namespace SPCVN\Repositories\Question;

use SPCVN\Question;

interface QuestionRepository
{
    /**
     * Get all system questions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Lists all system questions into $key => $column value pairs.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'name', $key = 'id');

    /**
     * Find system question by id.
     *
     * @param $id Question Id
     * @return Question|null
     */
    public function findById($id);

    /**
     * Find question by name:
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * Create new system question.
     *
     * @param array $data
     * @return Question
     */
    public function create(array $data);

    /**
     * Update specified question.
     *
     * @param $id Question Id
     * @param array $data
     * @return Question
     */
    public function update($id, array $data);

    /**
     * Remove question from repository.
     *
     * @param $id Question Id
     * @return bool
     */
    public function delete($id);

    /**
     * List all topic from repository.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allTopics();
}