<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    protected $fillable = ['id', 'user_id', 'name', 'position', 'del_flg'];
}
