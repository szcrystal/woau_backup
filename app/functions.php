<?php
/* functions *********** 
読み込みはpublic/index.php内にて
************************
*/


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
    
	if($first > $last) { //逆順の時 Yearにて
        for($first; $first >= $last; $first--) {
        	if(isset($objNum) && $first == $objNum)
            	echo '<option value="'.$first .'" selected>'.$first.'</option>';
            else
	            echo '<option value="'.$first .'">'.$first.'</option>';
        }
    }
    else {
        for($first; $first <= $last; $first++) {
        	if(isset($objNum) && $first == $objNum)
            	echo '<option value="'.$first .'" selected>'.$first.'</option>';
            else
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
    
    //echo strtotime($dateArg);
    
	if($type == 'dot') {
    	return $past['year']. '.' .$past['mon']. '.' . $past['mday'] .'';
    }
    else if($type == 'slash') {
    	return "<em>".$past['year']. "</em><br>" .$past['mon'].'/'. $past['mday'] .'';
	}
    else {
    	if(strtotime($dateArg) > 0)
			return $past['year'].'年'.$past['mon'].'月'. $past['mday'] .'日';
        
        //return date('Y年m月d日', strtotime($dateArg));
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

//singleページのページ送り
function pager($table, $id_arg) {
	
	if($table == 'irohas') {
    	$prev = DB::table($table) ->where(['slug'=>'study', 'closed'=>'公開中']) ->where('created_at', '<', $id_arg) -> orderBy('created_at', 'desc') -> first();
    	$next = DB::table($table) ->where(['slug'=>'study', 'closed'=>'公開中']) ->where('created_at', '>', $id_arg) -> orderBy('created_at', 'ASC')-> first();
    }
    else {
    	$prev = DB::table($table) ->where('closed', '公開中') ->where('created_at', '<', $id_arg) -> orderBy('created_at', 'desc') -> first();
    	$next = DB::table($table) ->where('closed', '公開中') ->where('created_at', '>', $id_arg) -> orderBy('created_at', 'ASC') -> first();
    }
    
    
    function linkFunc($arg, $table) {
    	if($table == 'irohas') 
        	$link = 'iroha/'. $arg->slug . '/' . $arg->id;
        
        elseif($table == 'jobs') 
        	$link = 'recruit/job/' . $arg->job_number;
        
        else 
            $link = $arg->slug.'/'.$arg->id;
            
        return $link;
    }
    
    $format = '<ul class="pager">';
    
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

//一覧ページ内の記事抜粋関数
function readMoreContents($arg, $path) {

    if($arg != '') {
        
        $ret = strip_tags($arg);
        
        if(mb_strlen($ret) > 100) {
            $ret = mb_substr($ret, 0, 100);
            $ret .= '<a href="'. getUrl($path) . '" class="dots">・・・</a>';
        }
        
        $ret .= '<a href="' . getUrl($path) . '" class="more">Read More<span class="octicon octicon-chevron-right"></span><span class="octicon octicon-chevron-right"></span></a>';
        return $ret;
    }
}

//DashBoardのuserinfo一覧で使用 長文を抜粋する
function mbsub($arg) {
	if(mb_strlen($arg) > 75)
		return mb_substr($arg, 0, 75) . "..";
    else
    	return $arg;
}


//User Agent Check
function isAgent($agent) {

    $ua_sp = array('iPhone','iPod','Mobile ','Mobile;','Windows Phone','IEMobile');
    $ua_tab = array('iPad','Kindle','Sony Tablet','Nexus 7','Android Tablet');
    $all_agent = array_merge($ua_sp, $ua_tab);
    
    switch($agent) {
        case 'sp':
            $agent = $ua_sp;
            break;
    
        case 'tab':
            $agent = $ua_tab;
            break;
        
        case 'all':
            $agent = $all_agent;
            break;
            
        default:
            //$agent = '';
            break;
    }
       
    if(is_array($agent)) {
        $agent = implode('|', $agent);
    }
    
    //$_SERVER['HTTP_USER_AGENT'] 取得に失敗している時があるのでenv()でdefault値も合わせて指定 Logにて確認
    //env('HTTP_USER_AGENT', '')に変更予定
    return preg_match('/'. $agent .'/', $_SERVER['HTTP_USER_AGENT']); 
    
}


//isLocal
function isLocal() {
	return (env('SERVER_NAME') == 'localhost'); //env()ヘルパー：環境変数（$_SERVER）の値を取得 .env内の値も$_SERVERに入る
}

function isServer() {
	return $_SERVER['SERVER_NAME'] == 'woman-auditor.com';
}

