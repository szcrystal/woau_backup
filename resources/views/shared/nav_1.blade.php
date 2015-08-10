<?php $s_info = DB::table('siteinfos')->first(); ?>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{{$s_info->site_name}}</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="{{ getUrl('/') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="mega-octicon octicon-three-bars"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <?php 
                            $names = DB::table('pages')-> whereNotIn('id', [$s_info->top_id])->get()/*->lists('sub_title')*/;

                            foreach($names as $name) {
                                if($name->sub_title != '') {
                                    echo '<li><a href="'. getUrl($name->url_name) . '">' . $name->sub_title .'</a></li>';
                                }
                                else {
                                	echo '<li><a href="'. getUrl($name->url_name) . '">Page-' . $name->id .'</a></li>';
                                }
                            }
                        ?>
                            <li><a href="{{ getUrl('topics') }}">TOPICS</a></li>
                            {{-- <li><a href="{{ getUrl('dashboard') }}" target="_blank">dashboard</a></li> --}}
                            
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ getUrl('auth/login') }}">Login</a></li>
                        <li><a href="{{ getUrl('auth/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} さん<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->admin == 10)
                                <li><a href="{{ getUrl('profile/' . Auth::user()->user_number) }}">プロフィール</a></li>
                                @endif
                                <li><a href="{{ getUrl('recruit') }}">求人一覧</a></li>
                                <li><a href="{{ getUrl('recruit/newjobs') }}">新着求人一覧</a></li>
                                <li><a href="{{ getUrl('/iroha') }}">監査役いろは</a></li>
                                <li><a href="{{ getUrl('/blog') }}">ブログ</a></li>
                                <li><a href="{{ getUrl('auth/logout') }}">ログアウト</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        
    </nav>
