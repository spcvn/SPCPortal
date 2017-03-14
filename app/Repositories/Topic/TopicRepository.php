<?php

namespace SPCVN\Repositories\Topic;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;

interface TopicRepository
{
    /**
     * Get all topic.
     *
     * @param none
     * @return \Illuminate\Database\Eloquent\Collection
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function all();

    /**
     * Topic pagination.
     *
     * @param (int) $perPage
     * @param (string) null $search
     * @param (string) null $status
     * @return mixed
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function paginate($perPage, $search = null);


    /**
     * Find topic by id.
     *
     * @param (int) $id
     * @return null|Array
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function find($id);

    /**
     * Count topic.
     *
     * @param (array) $condition
     * $condition = array (
     *		'parent_id'	=>	1,
     *		'name'		=> 'HTML',
     *		'user_id'	=>	1,
     *		'del_flag'	=>	0,
     *		'created'	=>	'2017-03-07 11:18:29'
     * );
     * Which key of $condition are corresponding with columns of table
     * @return int
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function count($condition = array());

    /**
     * Get list topic by key => value.
     *
     * @param (string) $column
     * @param (int) $id
     * @return null|Array
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function lists($column = 'name', $key = 'id');

    /**
     * Find topic by name.
     *
     * @param (string) $name
     * @return null|Array
	 *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function findByName($name);

    /**
     * Create new topic.
     *
     * @param (array) $data
     * @return mixed
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function create(array $data);

    /**
     * Update topic by id.
     *
     * @param (int) $id
     * @param (array) $data Data to update
     * @return mixed
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function update($id, $data);

    /**
     * Delete topic by id.
     *
     * @param (int) $id
     * @return mixed
     *
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function delete($id);

    /**
     * Update topic of topic by id.
     *
     * @param (array) $data
     * $data = array (
     *      0   => topic_id,
     *      1   => topic_id,
     *      2   => topic_id
     * )
     *
     * Key is order, Value is topic ID
     *
     * @return boolean
     *
     * @author Dinh Van Huong
     * @since 2017.03.08
     * @version 1.0
     */
    public function updatePosition($data);

    /**

     * set mentors for topic.
     *
     * @param (int) $topicId
     * @param array $userID
     * @param boolean $sync | false is created, true is updated
     * @return mixed
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function setMentors($topicId, $userID, $sync);


     * get memtor list by topic id
     *
     * @param (int) $id
     * @return null|Array
     *
     * @author Nguyen Chat Hien
     * @since 2017.03.13
     * @version 1.0
     */
    public function getMemtorsByTopicId($id);

}
