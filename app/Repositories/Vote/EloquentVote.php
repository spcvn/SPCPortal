<?php

namespace SPCVN\Repositories\Vote;

use SPCVN\Vote;
use SPCVN\Support\Authorization\CacheFlusherTrait;
use DB;

class EloquentVote implements VoteRepository
{
    use CacheFlusherTrait;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Vote::all();
    }

    /**
     * {@inheritdoc}
     */
    public function checkExists($data)
    {
        if (!isset($data['type']) || !isset($data['object_id']) || !isset($data['user_id'])) {
            return false;
        }

        $query = Vote::query();
        $query->where('type', $data['type']);
        $query->where('object_id', $data['object_id']);
        $query->where('user_id', $data['user_id']);
        $res = $query->get()->toArray();

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function create($data)
    {
        return Vote::create($data);
    }

    public function checkType($type)
    {
        /*
        $authority = [];
        $table = 'votes';
        $field = 'type';
        $_type = $this->TblMstepMasterUser->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" );
        $type = $_type[0]['COLUMNS']['Type'];
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $_authority = explode("','", $matches[1]);
        */
    }

    /**
     * {@inheritdoc}
     */
    public function getVotesByTopicID($topicID)
    {
        $query = Vote::query();
        $query->where('type', 'topic');
        $query->where('object_id', $topicID);
        return $query->get();
    }

}
