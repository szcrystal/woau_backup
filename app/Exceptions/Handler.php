<?php

namespace App\Exceptions;

use Exception;
use Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
    	
    	//if ($e instanceof Swift_TransportException) { //instanceof型判定が効かない　なぜか不明
        //メールが送れない時　smtpサーバーに接続できない時など　ユーザー側のネットワーク不良も関連する
        if (app()->environment() != 'local' && $e instanceof Exception && get_class($e) == 'Swift_TransportException') { 
        	Log::error('Exception Error: '. get_class($e) .' Mail sending is Not. On: '. $request->path() . ' by szk log' ."\n".$e);
            return response()->view('errors.mailerror', [], 500);
        }
    
        return parent::render($request, $e);
    }
}
