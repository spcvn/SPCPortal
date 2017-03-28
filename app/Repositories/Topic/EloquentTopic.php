<?php

namespace SPCVN\Repositories\Topic;

use SPCVN\Events\Topic\Created;
use SPCVN\Events\Topic\Deleted;
use SPCVN\Events\Topic\Updated;
use SPCVN\Topic;
use SPCVN\User;
use Carbon\Carbon;
use DB;
use Auth;
//use Illuminate\Database\SQLiteConnection;
//use SPCVN\Support\Authorization\CacheFlusherTrait;

define('ADMINISTRATOR', 1);

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
        $query = Topic::with(['topics_tags', 'user', 'topics_mentors'])
                    ->where('topics.del_flag', false);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('topics.topic_name', "like", "%{$search}%");
                $q->orWhere('topics.created', "{$search}");
            });
        }


        $query->orderBy('topics.created', 'DESC');
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
        $mentors = (isset($data['mentors'])) ? $data['mentors'] : [];
        event(new Created($topic, $mentors));
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data = array())
    {
        $oldMentors = [];
        $topic = Topic::with('topics_mentors')->find($id);

        foreach ($topic->topics_mentors as $user) {
            $oldMentors[] = $user->id;
        }

        $topic->update($data);
        $mentors = (isset($data['mentors'])) ? $data['mentors'] : [];
        event(new Updated($topic, $mentors, $oldMentors));
        return $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $oldMentors = [];
    	$topic = $this->find($id);

        foreach ($topic->topics_mentors as $user) {
            $oldMentors[] = $user->id;
        }

        $topic->update(['del_flag' => true]);
        event(new Deleted($topic, $oldMentors));
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

        return $this->find($topicID)->topics_mentors()->sync($data, $sync);
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

        return $this->find($topicID)->topics_tags()->sync($data, $sync);
    }

    /**
     * {@inheritdoc}
     */
    public function getMemtorsByTopicId($id)
    {
        $memtors = $this->find($id);

        return $memtors;
    }

    /**
     * {@inheritdoc}
     */
    public function alphaID ($in, $to_num = false, $pad_up = false, $pass_key = null)
    {
        $out   =   '';
        //$index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $index = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $base  = strlen($index);

        if ($pass_key !== null) {
            // Although this function's purpose is to just make the
            // ID short - and not so much secure,
            // with this patch by Simon Franz (http://blog.snaky.org/)
            // you can optionally supply a password to make it harder
            // to calculate the corresponding numeric ID

            for ($n = 0; $n < strlen($index); $n++) {
                $i[] = substr($index, $n, 1);
            }

            $pass_hash = hash('sha256',$pass_key);
            $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

            for ($n = 0; $n < strlen($index); $n++) {
                $p[] =  substr($pass_hash, $n, 1);
            }

            array_multisort($p, SORT_DESC, $i);
            $index = implode($i);
        }

        if ($to_num) {
            // Digital number  <<--  alphabet letter code
            $len = strlen($in) - 1;

            for ($t = $len; $t >= 0; $t--) {
                $bcp = bcpow($base, $len - $t);
                $out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;

                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;

                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a   = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in  = $in - ($a * $bcp);
            }
        }

        return $out;
    }

    /**
     * {@inheritdoc}
     */
    public function checkExistsName($data)
    {
        if (isset($data['topic_name']) && empty($data['topic_name'])) {
            return false;
        }

        $query = Topic::query();
        $query->select('id', 'topic_name');
        $query->where('del_flag', false);

        if (isset($data['topic_id']) && $data['topic_id']) {
            $query->where('id', '<>', $data['topic_id']);
        }        

        if (isset($data['category_id']) && $data['category_id']) {
            $query->where('category_id', $data['category_id']);
        }

        $name = trim($data['topic_name']);
        $query->where('topic_name', $name);

        $results = $query->get()->toArray();

        if ($results) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function listsTopicByUser($userID = 0)
    {
        if (empty($userID)) {
            return array();
        }

        // get topic from topic mentors
        $user = User::find($userID);
        $role = $user->roles->first()->id;
        $topicIDs = [];

        // get topic from topics table
        $topics = Topic::query();
        $topics->where('del_flag', false);

        if ($role != ADMINISTRATOR) {

            foreach ($user->topics as $topic) {
                $topicIDs[$topic->id] = $topic->topic_name;
            }

            $topics->where(function ($q) use ($userID) {
                $q->where('public', true);
                $q->orWhere('user_id', $userID);
            });
        }

        $results = $topics->get();
        foreach ($results as $result) {
            $topicIDs[$result->id] = $result->topic_name;
        }

        return $topicIDs;
    }
}

