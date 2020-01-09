<?php

namespace App\Helpers;

use App\Http\Requests\SettingUpdateSiteAssetsRequest;
use App\Models\Configuration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait SettingsHelper
{
    /**
     * Store image into disk
     *
     * @param SettingUpdateSiteAssetsRequest $request
     * @param $configKeyName
     */
    private function storeImage(SettingUpdateSiteAssetsRequest $request, $configKeyName)
    {
        if (in_array($configKeyName, config('constants.CONFIG_KEY'))) {
            $fileExtension = $request->file($configKeyName)->getClientOriginalExtension();

            $fileName = $configKeyName . '_' . time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
            $uploadPath = Str::finish(public_path(config('constants.UPLOAD.LOGO_ICON')), '/');

            $image = Image::make($request->file($configKeyName));
            $image->orientate();
            $image->save($uploadPath . $fileName);
            Configuration::where('config_key', $configKeyName)->update(array('config_value' => $fileName));
        }
    }

    private function deleteImage($configKey)
    {
        $oldFileName = Configuration::where('config_key', $configKey)->value('config_value');
        $oldFilePath = public_path(config('constants.UPLOAD.LOGO_ICON')) . '/' . $oldFileName;
        if(File::exists($oldFilePath)){
            File::delete($oldFilePath);
        }
    }
}
