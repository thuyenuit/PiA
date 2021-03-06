<?php

namespace App\ViewModels;

use Illuminate\Database\Eloquent\Model;

class FieldViewModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'id',
        'name',
        'field_group_id',
        'label_locale',
        'field_type',
        'default_value',
        'max_length',
        'sequence',
        'mandatory',
        'active',
        'show_in_report',
        'show_in_portal',
        'setting',
        'created_at',
        'updated_at'
    ];
}
