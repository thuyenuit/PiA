<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public $timestamps = true;

    /**
     * The database table used by model.
     *
     * @var string
     */
    protected $table = 'services';

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
    protected $fillable = ['name', 'locale_key'];
}
