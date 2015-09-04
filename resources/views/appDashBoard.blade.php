<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
	<title>DashBoard | woman x auditor</title>
	
	{{-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> --}}
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    {{-- <link href="{{ asset('/bootstrap/css/bootswatch.css') }}" rel="stylesheet"> --}}
	<link href="{{ asset('/bootstrap/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dbd.css') }}" rel="stylesheet">

    <!-- vector icon : octicon on github-->
    <link rel="stylesheet" href="{{ asset('/bootstrap/fonts/octicons/octicons.css') }}">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ asset('/js/dbd_script.js') }}"></script>
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
</head>
<body class="dashboard">

	@if (Auth::check())
  	
    <header>
    	<h1 class="col-md-offset-2">&nbsp;&nbsp;&nbsp;</h1>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/dashboard">DashBoard</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        {{-- <li><a href="{{ url('/') }}">Site TOP</a></li> --}}
                        
                        <li class="dropdown">
                            <a href="{{ url('/dashboard') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MENU <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ getUrl('/dashboard') }}">Home</a></li>
                                <li><a href="{{ getUrl('/') }}" target="_brank">サイトを表示</a></li>
                                <li><a href="{{ getUrl('/dashboard/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::User())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin : {{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/dashboard/logout') }}">Logout</a></li>
                            		<li><a href="{{ url('/dashboard/register') }}">Register</a></li>
                                </ul>
                            </li>
                        @else
                        @endif
                    </ul>
                </div>
                
                <!--
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="">top</a>
                    <li><a href="/reservation/">reserve</a>
                    <li><a href="/home">login</a>
                    <li><a href="/dashboard/">dashboard</a>
                </ul>
                -->
            </div>
        </nav>
	</header>
    
    <?php 
    	function addCurrent($linkArg, $arg2='') {
        	if(Request::is('dashboard') && $linkArg == 'home') {
            	return ' class="active"';
            }
        	else {
            	if($arg2 == '') {
                	if(Request::is('dashboard/'. $linkArg .'*')) 
                    	return ' class="active"';
                }
                else {
                	if(Request::is('dashboard/'. $linkArg .'*') || Request::is('dashboard/'. $arg2 .'*'))
                    	return ' class="active"';
                }
            }
        }
    ?>
    
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li{!!addCurrent('home')!!}><a href="/dashboard"><span class="octicon octicon-home"></span>Dashboard Top<span class="sr-only">(current)</span></a>
            </li>{{--  class="active" --}}
            
            <li{!!addCurrent('pages')!!}><a href="{{url('/dashboard/pages')}}" class="onSlide"><span class="octicon octicon-book"></span>固定ページ</a></li>
            <li>
                <ul class="slide">
                    <li><a href="{{url('/dashboard/pages')}}">固定ページ一覧</a></li>
                    <li><a href="{{url('/dashboard/pages-add')}}">新規追加</a></li>
                </ul>
            </li>
          </ul>
          
          <ul class="nav nav-sidebar">
            <li{!!addCurrent('jobs')!!}><a href="{{url('/dashboard/jobs')}}" class="onSlide"><span class="octicon octicon-file-directory"></span>案件情報</a></li>
            <li>
            	<ul class="slide">
                    <li><a href="{{url('/dashboard/jobs')}}">案件情報一覧</a></li>
                    <li><a href="{{url('/dashboard/jobs-add')}}">新規案件追加</a></li>
                    <li><a href="{{url('/dashboard/jobs-entry')}}">案件応募者一覧</a></li>
            	</ul>
            </li>
          </ul>
          
          <ul class="nav nav-sidebar">
            <li{!!addCurrent('topics')!!}><a href="{{getUrl('/dashboard/topics')}}" class="onSlide"><span class="octicon octicon-megaphone"></span>トピックス</a></li>
            <li>
                <ul class="slide">
                    <li><a href="{{getUrl('/dashboard/topics')}}">トピックス一覧</a></li>
                    <li><a href="{{getUrl('/dashboard/topics-add')}}">新規トピックス追加</a></li>

                </ul>
            </li>
          </ul>
          
          <ul class="nav nav-sidebar">
            <li{!!addCurrent('iroha', 'study')!!}><a href="{{getUrl('/dashboard/irohas')}}" class="onSlide"><span class="octicon octicon-repo"></span>監査役いろは</a></li>
            <li>
                <ul class="slide">
                    <li><a href="{{getUrl('/dashboard/irohas')}}">いろはページ一覧</a></li>
                    <li><a href="{{getUrl('/dashboard/irohas-add')}}">いろはページ追加</a></li>
                    <li><a href="{{getUrl('/dashboard/study')}}">勉強会一覧</a></li>
                    <li><a href="{{getUrl('/dashboard/study-add')}}">勉強会追加</a></li>
                    <li><a href="{{getUrl('/dashboard/study-entry')}}">勉強会参加者一覧</a></li>
                </ul>
            </li>
          </ul>
          
          
          <ul class="nav nav-sidebar">
            <li{!!addCurrent('blog', 'cate')!!}><a href="{{getUrl('/dashboard/blog')}}" class="onSlide"><span class="octicon octicon-file-text"></span>ブログ</a></li>
            <li>
                <ul class="slide">
                    <li><a href="{{getUrl('/dashboard/blog')}}">ブログ一覧</a></li>
                    <li><a href="{{getUrl('/dashboard/blog-add')}}">ブログ追加</a></li>
                    <li><a href="{{getUrl('/dashboard/category')}}">カテゴリー一覧/追加</a></li>
                    {{--<li><a href="{{getUrl('/dashboard/category-add')}}">新規追加</a></li>--}}
                </ul>
            </li>
          </ul>
          
          {{--
          <ul class="nav nav-sidebar">
            <li><a href="">画像</a></li>
            <li>
                <ul>
                    <li><a href="{{getUrl('/dashboard/images')}}">画像一覧</a></li>
                    <li><a href="{{getUrl('/dashboard/images-add')}}">新規画像追加</a></li>
                    <li><a href="">Another nav item</a></li>
                </ul>
            </li>
          </ul>
          --}}
          {{--
          <ul class="nav nav-sidebar">
            <li><a href="{{url('/dashboard/cates')}}"><span class="octicon octicon-file-code"></span>カテゴリー</a></li>
           <li>
                <ul>
                    <li><a href="{{getUrl('/dashboard/cates')}}">カテゴリー一覧</a></li>
                    <li><a href="{{getUrl('/dashboard/cates/add')}}">新規追加</a></li>
                    <li><a href="">Another nav item</a></li>
                    <li><a href="">More navigation</a></li>
                </ul>
            </li>
          </ul>
          --}}
          
          <ul class="nav nav-sidebar">
            <li{!!addCurrent('siteinfo')!!}><a href="/dashboard/siteinfo"><span class="octicon octicon-device-desktop"></span>サイト情報/メール</a></li>
            <li{!!addCurrent('register')!!}><a href="/dashboard/register"><span class="octicon octicon-key"></span>管理者追加</a></li>
            <li{!!addCurrent('userinfo')!!}><a href="/dashboard/userinfo"><span class="octicon octicon-person"></span>登録ユーザー情報</a></li>
          </ul>
          
          {{--
            <form class="navbar-form navbar-right">
                <input type="search" class="form-control" placeholder="Search...">
            </form>
           --}} 
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    		@yield('content')
        </div>
        
    	</div>
    </div>
    
    {{-- login画面 --}}
    @else
    	
            <div class="col-md-10 col-md-offset-1 wrap-panel">
                @yield('content')
            </div>
        
    @endif
    

</body>
</html>
