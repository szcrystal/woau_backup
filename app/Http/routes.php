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

//Iroha
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




/* functions *********** */
//改行させる
function nb($arg) {
	return nl2br($arg, FALSE); //false:HTML準拠の<br>を出力
}

function selectBox($first, $last, $objNum=null) {
	
    if($objNum == null) {
    	echo '<option value="--" selected>--</option>';
    }
    else {
    	$select = ($objNum == '0000' || $objNum == '00') ? ' selected' : '';
    	echo '<option value="--"' . $select .'>--</option>';
    }
    
	if($first > $last) { //逆順の時
        for($first; $first >= $last; $first--) {
        	if(isset($objNum) && $first == $objNum)
            	echo '<option value="'.$first .'" selected>'.$first.'</option>';
            
            echo '<option value="'.$first .'">'.$first.'</option>';
        }
    }
    else {
        for($first; $first <= $last; $first++) {
        	if(isset($objNum) && $first == $objNum)
            	echo '<option value="'.$first .'" selected>'.$first.'</option>';
                
            echo '<option value="'.$first .'">'.$first.'</option>';
        }
    }
}


function getUrl($linkArg) {
	if(getenv('LARAVEL_ENV') === 'heroku') {
    	//return secure_url($linkArg);
        return url($linkArg);
    }
    else {
    	return url($linkArg);
    }
}

function getStrDate($dateArg, $type='') {
	
    $past = getdate(strtotime($dateArg));
    
	if($type == 'dot') {
    	return $past['year']. '.' .$past['mon']. '.' . $past['mday'] .'';
    }
    else if($type == 'slash') {
    	return "<em>".$past['year']. "</em><br>" .$past['mon'].'/'. $past['mday'] .'';
	}
    else {
		return $past['year'].'年'.$past['mon'].'月'. $past['mday'] .'日';
    }
}

function listCategory($blog_id) {
	if( $cates = App\Blog::find($blog_id)->cateRelation ) {
                        
        $ret = '<ul style="list-style:none;" class="clearfix">'."\n";
        
        foreach($cates as $cate) {
            $cateObj = App\Cate::find($cate->cate_id);
            
            $ret .='<li class="pull-left">';
            $ret .= '<a href="'. getUrl("blog/category/".$cateObj->slug) .'">' . $cateObj->c_name . '</a>';
            $ret .= '</li>'."\n";
        }
         
        $ret .= '</ul>'."\n";
        
        return $ret;
    }
    else {
    	return '';
    }
}

function pager($table, $id_arg) {
	
	if($table == 'irohas') {
    	$prev = DB::table($table)->where('slug', 'study')->where('id', '<', $id_arg) -> orderBy('created_at', 'desc') -> first();
    	$next = DB::table($table)->where('slug', 'study')->where('id', '>', $id_arg) -> first();
    }
    else {
    	$prev = DB::table($table)->where('id', '<', $id_arg) -> orderBy('created_at', 'desc') -> first();
    	$next = DB::table($table)->where('id', '>', $id_arg) -> first();
    }
    
    
	$format = '<ul class="pager">';
    
    function linkFunc($arg, $table) {
    	if($table == 'irohas') 
        	$link = 'iroha/'. $arg->slug . '/' . $arg->id;
        
        elseif($table == 'jobs') 
        	$link = 'recruit/job/' . $arg->job_number;
        
        else 
            $link = $arg->slug.'/'.$arg->id;
            
        return $link;
    }
    
    
    
    if(isset($prev)) {
    	$format .= '<li><a href="' . getUrl(linkFunc($prev, $table)) . '" rel="prev">PREV</a></li>';
    }
    else {
        $format .= '<li class="disabled"><span>PREV</span></li>';
    }
    
    if(isset($next)) {
    	
    	//$link = ($table == 'irohas') ? 'iroha/'. $next->slug : $next->slug;
        $format .= '<li><a href="'. getUrl(linkFunc($next, $table)) .'" rel="next">NEXT</a></li>';
    }
    else {
        $format .= '<li class="disabled"><span>NEXT</span></li>';
	}
    
    $format .= '</ul>'."\n";
    
    return $format;
}



/* *****************************
最後にルートキャッシュの登録をすること
php artisan route:cache

クリアの場合
php artisan route:clear

http://readouble.com/laravel/5/1/ja/controllers.html#route-caching
******************************* */





