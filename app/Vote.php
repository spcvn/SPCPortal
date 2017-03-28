<?php

namespace SPCVN;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    const CREATED_AT    = 'created';
    const UPDATED_AT    = 'modified';

    protected $primarykey = 'id';

    protected $fillable = ['id', 'user_id', 'type', 'object_id', 'point', 'comments', 'created', 'modified'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
