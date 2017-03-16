<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table 	= 'categories';

    const CREATED_AT 	= 'created';
    const UPDATED_AT 	= 'modified';

    protected $fillable = ['parent_id', 'user_id', 'name', 'description', 'position', 'del_flag', 'created', 'modified'];


}
