<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FeatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole("admin")) {
            $featuresList = \Config::get('constants.FEATURES_LIST');
            $prefix = $request->route()->getPrefix();
            $prefix = strtolower(trim(str_replace("/", "", $prefix)));
            if (in_array($prefix, $featuresList)) {
                //accessing feature- check has permissions or not
                $allowedFeatures = (auth()->user()->allowed_features == NULL ? [] : json_decode(auth()->user()->allowed_features, true));
                if (!in_array($prefix, $allowedFeatures)) {
                    return abort(403, "You don't have access permission to this feature!");
                }
            }
        }
        return $next($request);
    }
}
