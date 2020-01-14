<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Club extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clubs';

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
        'name',
        'aircraft_type',
        'club_logo',
        'region',
        'address',
        'zip_code',
        'town',
        'email',
        'internet',
        'club_admin_ids',
        'chef_instructor_id',
        'club_contact_ids',
        'charge_club_of_quota',
        'monthly_payment',
    ];

    protected $casts = [
        'club_admin_ids' => 'array',
        'club_contact_ids' => 'array',
        'aircraft_type' => 'array',
    ];

    public function imageUrl(): string
    {
        $folder = Str::finish(config('constants.UPLOAD.CLUB_LOGO'), '/');
        $imagePath = public_path($folder) . $this->club_logo;
        if (!empty($this->club_logo) && File::exists($imagePath)) {
            return asset(config('constants.UPLOAD.CLUB_LOGO') . '/' . $this->club_logo);
        } else {
            return asset(config('constants.DEFAULT.CLUB_LOGO'));
        }
    }

}
