<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Models\Language;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set default string length in migration
        // 191 * 4 = 764 bytes. DB support maximum 767 bytes
        Schema::defaultStringLength(191);

        // Set variables that are used in all pages
        view()->composer('*', function ($view) {
            $app_icon_key = config('constants.CONFIG_KEY.SITE_FAVICON');
            if (Session::has($app_icon_key)) {
                $app_icon = Session::get($app_icon_key);
            } else {
                $app_icon = Configuration::imageUrlByKey($app_icon_key);
                Session::put($app_icon_key, $app_icon);
            }

            $app_logo_key = config('constants.CONFIG_KEY.SITE_LOGO');
            if (Session::has($app_logo_key)) {
                $app_logo = Session::get($app_logo_key);
            } else {
                $app_logo = Configuration::imageUrlByKey($app_logo_key);
                Session::put($app_logo_key, $app_logo);
            }

            $app_login_bg_key = config('constants.CONFIG_KEY.LOGIN_IMAGE');
            if (Session::has($app_login_bg_key)) {
                $app_login_bg = Session::get($app_login_bg_key);
            } else {
                $app_login_bg = Configuration::imageUrlByKey($app_login_bg_key);
                Session::put($app_login_bg_key, $app_login_bg);
            }

            $app_avatar_key = config('constants.CONFIG_KEY.DEFAULT_AVATAR_IMAGE');
            if (Session::has($app_avatar_key)) {
                $app_avatar = Session::get($app_avatar_key);
            } else {
                $app_avatar = Configuration::imageUrlByKey($app_avatar_key);
                Session::put($app_avatar_key, $app_avatar);
            }

            $app_languages = Language::get();

            $view->with('app_icon', $app_icon)
                ->with('app_logo', $app_logo)
                ->with('app_login_bg', $app_login_bg)
                ->with('app_avatar', $app_avatar)
                ->with('app_languages', $app_languages);
        });
    }
}
