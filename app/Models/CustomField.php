<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    public $timestamps = true;

    /**
     * The database table used by model.
     *
     * @var string
     */
    protected $table = 'custom_fields';

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
        'custom_field_group_id',
        'label_locale',
        'field_type',
        'sequence', 
        'mandatory',
        'active',
        'show_in_report',
        'show_in_portal',
        'setting'
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function custom_field_group()
    {
        return $this->belongsTo('App\Models\CustomFieldGroup');
    }

    public function custom_field_members()
    {
        return $this->hasMany('App\Models\CustomField');
    }
}
