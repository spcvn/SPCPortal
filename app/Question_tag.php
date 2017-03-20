<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Question_tag extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions_tags';

    protected $fillable = ['question_id', 'tag_id'];

}
