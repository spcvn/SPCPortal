<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answers';

    protected $fillable = ['question_id', 'parent_id', 'user_id', 'comment', 'del_flg'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
