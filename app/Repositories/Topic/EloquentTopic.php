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
    	$query = Topic::query();
        $query->where('del_flag', false);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('created', $search);
            });
        }

        $result = $query->orderBy('created', 'ASC')
                        ->orderBy('topic_name', 'ASC')
            			->paginate($perPage);

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
}