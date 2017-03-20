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

    protected $fillable = ['facebook', 'twitter', 'google_plus', 'dribbble', 'linked_in', 'skype'];
}
