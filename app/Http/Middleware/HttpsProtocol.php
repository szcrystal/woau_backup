<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol
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

//	    if (!$request->isSecure() && getenv('LARAVEL_ENV') === 'heroku') {
//    	    //return redirect() -> secure($request->path());
//            return redirect(secure_url($request->path()));
//    	}

//		if (getenv('LARAVEL_ENV') === 'heroku') {
//            // for Proxies
//            $request->setTrustedProxies([$request->getClientIp()]);
//            if (!$request->isSecure()) {
//                return redirect()->secure($request->getRequestUri());
//            }
//        }
    
        return $next($request);
    }
}

