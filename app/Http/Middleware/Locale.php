<?php

namespace App\Http\Middleware;

use App;
use Session;
use Closure;
use Config;
use Lang;
use Auth;
use Carbon\Carbon;
use App\Helpers\LocaleUtils;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale');
        if(!$locale) {
            $locale = \App::getLocale();
        }
        if(\Auth::check()) {
            $appSettings = Auth::user()->appSettings;
            foreach($appSettings as $appSetting ) {
                if($appSetting['key'] == "locale") $locale = $appSetting['value'];
            }
        }

        Session::put('locale', $locale);
        app()->setLocale($locale);

        return $next($request);
    }
}
