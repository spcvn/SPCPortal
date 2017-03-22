<?php

namespace SPCVN;

use SPCVN\Repositories\Topic\EloquentTopic;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table 	= 'topics';

    const CREATED_AT 	= 'created';
    const UPDATED_AT 	= 'modified';



    protected $fillable = ['category_id', 'user_id', 'topic_name', 'picture', 'description', 'view', 'public', 'del_flag', 'created', 'modified'];

    public function getEncryptIdAttribute()
    {
    	$topic = new EloquentTopic();
        return $topic->alphaID($this->id, false, NUMBER_CHARACTER_RANDOM);
    }

    public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

    public function topics_mentors()
	{
		return $this->belongsToMany(User::class, 'topics_mentors', 'topic_id', 'user_id');
	}

	public function topics_tags()
	{
		return $this->belongsToMany(Tag::class, 'topics_tags', 'topic_id', 'tag_id');
	}
}
