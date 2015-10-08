<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Main
Route::get('/', 'PageController@getIndex'); //名前付きルート
//Route::controller('/', 'PostsController');

// DashBoard
Route::get('dashboard', 'DashBoardController@getIndex');
Route::get('dashboard/login', 'Auth\AdminController@getLogin');
Route::post('dashboard/login', 'Auth\AdminController@postLogin');
Route::controller('dashboard', 'DashBoardController');
//RESTfullリソースコントローラー
//Route::resource('dashboard', 'AuthorController'); //↑controllerメソッドが既に指定済みだとresourceメソッドは効かな


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//Route::post('auth/register/end', 'Auth\AuthController@postRegisterEnd');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('/profile/{number}', 'UserController@getIndex');
Route::controller('profile', 'UserController');

Route::controller('recruit', 'JobController');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    //'admin' => 'Admin\AdminController',
]);


//Topics
Route::get('/topics', 'TopicController@getIndex');
Route::get('/topics/{topic_id}', 'TopicController@show');
Route::controller('/topics', 'TopicController');

//Iroha
Route::get('/iroha', 'IrohaController@getIndex');
Route::get('/iroha/{url_name}', 'IrohaController@show');
Route::controller('/iroha', 'IrohaController');

//Blog
Route::get('/blog', 'BlogController@getIndex');
Route::get('/blog/{post_id}', 'BlogController@show');
Route::controller('/blog', 'BlogController');

//All fix page
//Route::controller('/', 'PageController');
//Route::match(['get', 'post'], '/contact', 'PageController');
//Route::get('/contact', 'PageController@getContact');
Route::post('/contact', 'PageController@postContact');
Route::get('/{post}', 'PageController@show');
//Route::controller('/', 'PageController');

//function ($url_name) {
//    echo $url_name;
//});


/* Custom function 
app/functions.phpに記述
require_once(functions.php) -> public/index.phpへ
*/

/* *****************************
1,最後にルートキャッシュとConfigキャッシュの登録をすること
php artisan route:cache
php artisan config:cache

クリアの場合
php artisan route:clear
php artisan config:clear

http://readouble.com/laravel/5/1/ja/controllers.html#route-caching
http://readouble.com/laravel/5/1/ja/installation.html#configuration-caching

2,APP_DEBUG環境変数をtrueに .envファイルにて
http://readouble.com/laravel/5/1/ja/errors.html#configuration
本番：[APP_ENV] => production
    [APP_DEBUG] => false

3,jobs tableとirohas tableのmigrateファイルを直す
recreate_jobs_table
add_column_jos_study_table ファイルを追加しているので
追加しないように元のmigrateファイルを直す

******************************* */





