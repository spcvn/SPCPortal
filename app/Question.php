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
}
