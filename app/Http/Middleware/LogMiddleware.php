<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Auth;

class LogMiddleware
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
    	if(Auth::user()) {
            Log::info(
                'Admin user is in ID:'. Auth::user()->id.
                ', email:'. Auth::user()->email.
                ', Path:' . $request->path().
                //"\n".
                ', Env:' . env('HTTP_USER_AGENT', 'unrecognized'). //$_SERVER['HTTP_USER_AGENT'] 取得に失敗している時があるのでenv()でdefault値も合わせて指定 Logにて確認
                ', Time:' . date('Y-m-d H:i:s', time())
            );
        }
        else {
        	Log::info(
            	'Guest user is in '.
            	'Path:' . $request->path().
                ', Env:' . env('HTTP_USER_AGENT', 'unrecognized').
                ', Time:' . date('Y-m-d H:i:s', time())
            );
        }
        
        return $next($request);
    }
}

