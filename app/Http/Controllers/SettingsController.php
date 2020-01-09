<?php

namespace App\Http\Controllers;

use App\Helpers\SettingsHelper;
use App\Http\Requests\SettingUpdateSiteAssetsRequest;
use App\Models\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\TranslationLoader\LanguageLine;

class SettingsController extends Controller
{
    use SettingsHelper;

    /**
     * Display a listing of the app setting.
     *
     * @return Response
     */
    public function index()
    {
        $configurations = Configuration::select('id', 'config_key', 'config_value')->get();
        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.group_name'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.group_name'),
                    'active' => true,
                ],
                [
                    'text' => __('layouts.sidebar.settings.logo_icon'),
                    'active' => true,
                ],
            ]
        ];

        return view('settings.index', compact('breadcrumbs', 'configurations'));
    }

    /**
     * Update site assets
     *
     * @param SettingUpdateSiteAssetsRequest $request
     * @return RedirectResponse
     */
    public function updateSiteAssets(SettingUpdateSiteAssetsRequest $request)
    {
        $request->validated();

        $requestData = $request->all();

        foreach ($requestData as $key => $value) {
            // images
            if (Str::startsWith($key, 'delete_')) {
                $configKeyName = Str::replaceFirst('delete_', '', $key);
                if ($value === 'true') {
                    // delete old file
                    $this->deleteImage($configKeyName);

                    // store new file
                    if ($request->hasFile($configKeyName)) {
                        $this->storeImage($request, $configKeyName);
                    } else {
                        Configuration::where('config_key', $configKeyName)->update(array('config_value' => ''));
                    }
                    Session::remove($configKeyName);
                } else {
                    // store new file
                    if ($request->hasFile($configKeyName)) {
                        $this->deleteImage($configKeyName);
                        $this->storeImage($request, $configKeyName);
                        Session::remove($configKeyName);
                    }
                }
            }

            // app name
            if ($key == 'app_name') {
                $languageLine = LanguageLine::where('group', 'app')
                    ->where('key', 'name')
                    ->first();
                if (!empty($languageLine)) {
                    $languageLine->update(['text' => array_filter($value)]);
                }
            }
        }

        Session::flash('flash_message', trans('settings.flash_messages.update'));
        return redirect()->route('app_settings');
    }

    /**
     * Display a listing of the payment methods.
     *
     * @return Response
     */
    public function payment()
    {
        //
    }
}
