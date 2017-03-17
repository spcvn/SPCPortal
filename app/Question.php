<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    protected $fillable = ['topic_id', 'user_id', 'title', 'description', 'views', 'del_flg'];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question_tag()
    {
        return $this->belongsToMany(Tag::class, 'questions_tags', 'question_id', 'tag_id');
    }
}
