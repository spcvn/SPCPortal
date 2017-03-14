<?php

namespace SPCVN\Repositories\Topic;

use SPCVN\Topic;
use SPCVN\User;
use Carbon\Carbon;
use DB;
//use Illuminate\Database\SQLiteConnection;
//use SPCVN\Support\Authorization\CacheFlusherTrait;

class EloquentTopic implements TopicRepository
{
    //use CacheFlusherTrait;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Topic::all();
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage = 30, $search = null)
    {
        $query = DB::table('topics');
        $query->select('topics.*', 'users.first_name', 'users.last_name', 'users.username');
        $query->leftJoin('users', 'users.id', '=', 'topics.user_id');
        $query->where('topics.del_flag', false);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('topics.topic_name', "like", "%{$search}%");
                $q->orWhere('users.first_name', "like", "%{$search}%");
                $q->orWhere('users.last_name', "like", "%{$search}%");
                $q->orWhere('topics.created', $search);
            });
        }

        $query->orderBy('topics.created', 'ASC');
        $query->orderBy('topics.topic_name', 'ASC');
        $result = $query->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }


    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
    	return Topic::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'topic_name', $key = 'id')
    {
        return Topic::pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function count($condition = array())
    {
    	return true;
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
    	return true;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
    	$topic = Topic::create($data);
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data = array())
    {
    	$topic = $this->find($id);
        $topic->update($data);
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
    	$topic = $this->find($id);
        $topic->update(['del_flag' => true]);
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function updatePosition($data = array())
    {
        if (empty($data)) {
            return false;
        }

        try {
            DB::beginTransaction();

            foreach ($data as $position => $topic_id) {
                $topic = $this->find($topic_id);
                $topic->update(array('position' => $position));
            }

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */

    public function setMentors($topicID, $userID, $sync = 'false')
    {
        $data = [];
        if (is_array($userID) && !empty($userID[0])) {
            $data = $userID;
        }       

        return $this->find($topicID)->users()->sync($data, $sync);
    }


    public function getMemtorsByTopicId($id)
    {
        $memtors = $this->find($id);

        return $memtors;
    }
}

