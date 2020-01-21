<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'avatar',
        'birthday',
        'phone',
        'mobile_phone',
        'address',
        'zip_code',
        'town',
        'pilot_id',
        'fai_no',
        'fai_year',
        'd_no',
        'main_club_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function avatarUrl(): string
    {
        if (empty($this->avatar)) {
            return Configuration::imageUrlByKey(config('constants.CONFIG_KEY.DEFAULT_AVATAR_IMAGE'));
        }
    }
}
