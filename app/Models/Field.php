<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $timestamps = true;

    /**
     * The database table used by model.
     *
     * @var string
     */
    protected $table = 'fields';

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
        'name',
        'field_group_id',
        'locale_key',
        'field_type',
        'sequence',
        'mandatory',
        'active',
        'show_in_report',
        'show_in_portal',
        'setting'
    ];

    public function field_group()
    {
        return $this->belongsTo('App\Models\FieldGroup');
    }

    public function field_members()
    {
        return $this->hasMany('App\Models\Field');
    }
}
