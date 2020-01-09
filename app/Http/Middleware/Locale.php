<?php namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->hasCookie('locale')) {
            App::setLocale($request->cookie('locale'));
        }else{
            $primaryLanguage = Language::where('is_primary', true)->first();
            if(!empty($primaryLanguage)){
                App::setLocale($primaryLanguage->lang_key);
            }
        }

        $response = $next($request);
        return $response->withCookie(cookie()->forever('locale', App::getLocale()));
    }

}
