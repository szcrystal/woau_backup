<!DOCTYPE html>
<html lang="ja">
@include('shared.head')

<body class="main">

{{-- @include('shared.nav_1') --}}

    <div id="page">
    
    	<div id="head">
        	<h1><a href="{{ getUrl('/')}}"><img src="{{url('/images/main/logo-top.png')}}" /></a></h1>
        </div>
        
        @include('shared.nav')

        
    <div class="container-fluid">
			
            {{-- @if(str_contains(Request::path(), 'auth')) if ($request->is('auth/*')) --}}
            
            <div class="blog-main">
                @yield('content')
            </div>

			{{--
            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                <h4>About</h4>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>
                <div class="sidebar-module">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                    <li><a href="#">March 2014</a></li>
                    <li><a href="#">February 2014</a></li>
                    <li><a href="#">January 2014</a></li>
                    <li><a href="#">December 2013</a></li>
                    <li><a href="#">November 2013</a></li>
                    <li><a href="#">October 2013</a></li>
                    <li><a href="#">September 2013</a></li>
                    <li><a href="#">August 2013</a></li>
                    <li><a href="#">July 2013</a></li>
                    <li><a href="#">June 2013</a></li>
                    <li><a href="#">May 2013</a></li>
                    <li><a href="#">April 2013</a></li>
                </ol>
                </div>
                <div class="sidebar-module">
                <h4>Elsewhere</h4>
                <ol class="list-unstyled">
                <li><a href="#">GitHub</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                </ol>
                </div>
            </div><!-- /.blog-sidebar -->
        	--}}
            
    </div><!-- container -->
    
    @include('shared.footer')
    
    </div><!-- page -->
</body>
</html>
