<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomFieldGroup extends Model
{
    public $timestamps = true;

    /**
     * The database table used by model.
     *
     * @var string
     */
    protected $table = 'custom_field_groups';

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
        'label_locale',
        'sequence'
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function custom_fields()
    {
        return $this->hasMany('App\Models\CustomField');
    }
}
