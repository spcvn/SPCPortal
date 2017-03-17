<?php

namespace SPCVN\Repositories\Topic;

use SPCVN\Events\Topic\Created;
use SPCVN\Events\Topic\Deleted;
use SPCVN\Events\Topic\Updated;
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
        $query = Topic::with(['tags', 'user', 'users'])
                    ->where('topics.del_flag', false);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('topics.topic_name', "like", "%{$search}%");
                $q->orWhere('topics.created', "{$search}");
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
        event(new Created($topic));
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data = array())
    {
    	$topic = $this->find($id);
        $topic->update($data);
        event(new Updated($topic));
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
    	$topic = $this->find($id);
        $topic->update(['del_flag' => true]);
        event(new Deleted($topic));
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

    /**
     * {@inheritdoc}
     */
    public function setTags($topicID, $tagsID, $sync = 'false')
    {
        $data = [];
        if (is_array($tagsID) && !empty($tagsID[0])) {
            $data = $tagsID;
        }

        return $this->find($topicID)->tags()->sync($data, $sync);
    }

    /**
     * {@inheritdoc}
     */
    public function getMemtorsByTopicId($id)
    {
        $memtors = $this->find($id);

        return $memtors;
    }
}

