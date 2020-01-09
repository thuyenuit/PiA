<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Configuration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configurations';

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
        'config_key',
        'config_value',
    ];

    public function imageUrl(): ?string
    {
        $folder = Str::finish(config('constants.UPLOAD.LOGO_ICON'), '/');
        $imagePath = public_path($folder) . $this->config_value;
        if (!empty($this->config_value) && File::exists($imagePath)) {
            return asset(config('constants.UPLOAD.LOGO_ICON') . '/' . $this->config_value);
        } else {
            return Configuration::imageUrlDefaultByKey($this->config_key);
        }
    }

    public static function imageUrlByKey($key): ?string
    {
        $config = Configuration::where('config_key', $key)->first();
        if (empty($config)) {
            return Configuration::imageUrlDefaultByKey($key);
        } else {
            return $config->imageUrl();
        }
    }

    public static function imageUrlDefaultByKey($key): ?string
    {
        switch ($key) {
            case config('constants.CONFIG_KEY.SITE_FAVICON'):
                return asset(config('constants.DEFAULT.ICON'));
            case config('constants.CONFIG_KEY.SITE_LOGO'):
                return asset(config('constants.DEFAULT.LOGO'));
            case config('constants.CONFIG_KEY.DEFAULT_AVATAR_IMAGE'):
                return asset(config('constants.DEFAULT.AVATAR'));
            case config('constants.CONFIG_KEY.LOGIN_IMAGE'):
                return asset(config('constants.DEFAULT.LOGIN_BG'));
            default:
                return null;
        }
    }
}
