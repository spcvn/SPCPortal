<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table 	= 'topics';

    const CREATED_AT 	= 'created';
    const UPDATED_AT 	= 'modified';

    protected $fillable = ['category_id', 'user_id', 'topic_name', 'picture', 'description', 'view', 'public', 'del_flag', 'created', 'modified'];

    public function users()
	{
		return $this->belongsToMany(User::class, 'topics_mentors', 'topic_id', 'user_id');
	}
}
