<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * @param $language
     * @return RedirectResponse|Redirector
     */
    public function changeLocalization($language)
    {
        App::setLocale($language);
        return Redirect::back()->withCookie('locale', App::getLocale());
    }
}
