<?php

namespace SPCVN\Repositories\Vote;

use SPCVN\Vote;

interface VoteRepository
{
    /**
     * Get all system Vote.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * check exists
     *
     * @param array $data
     * $data = array (
     *      'type'      =>  'Type Name',
     *      'object_id' =>  'Object ID',
     *      'user_id'   =>  'User ID'
     *  )
     * @return boolean
     *
     * @since 2017.03.28
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function checkExists($data);

    /**
     * create new row
     *
     * @param array $data
     * $data = array (
     *      'type'      =>  'Type Name',
     *      'object_id' =>  'Object ID',
     *      'user_id'   =>  'User ID'
     *  )
     * @return mixed
     *
     * @since 2017.03.28
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function create($data);

    /**
     * create new row
     *
     * @param array $data
     * $data = array (
     *      'type'      =>  'Type Name',
     *      'object_id' =>  'Object ID',
     *      'user_id'   =>  'User ID'
     *  )
     * @return mixed
     *
     * @since 2017.03.28
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function checkType($type);

    /**
     * get votes by topic ID
     *
     * @param int $topicID
     * @return array
     *
     * @since 2017.03.28
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function getVotesByTopicID($topicID);

}
