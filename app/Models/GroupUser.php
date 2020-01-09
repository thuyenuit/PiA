<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    public $timestamps = true;

    /**
     * The database table used by model.
     *
     * @var string
     */
    protected $table = 'groups_users';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'user_id', 'club_id'];

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function club()
    {
        return $this->belongsTo('App\Models\Club');
    }
}
