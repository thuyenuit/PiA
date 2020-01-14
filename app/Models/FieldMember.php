<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldMember extends Model
{
    public $timestamps = true;

    /**
     * The database table used by model.
     *
     * @var string
     */
    protected $table = 'field_members';

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
    protected $fillable = [
        'field_id',
        'member_id',
        'value'
    ];

    public function fields()
    {
        return $this->hasMany('App\Models\Field');
    }
}
