<!DOCTYPE html>
<html lang="ja">
@include('shared.head')

<body class="main">
<div id="o-belt"></div>
{{--
@if(getenv('LARAVEL_ENV') != 'heroku')
@include('shared.nav_1')
@endif
--}}

    <div id="page">
        
        @include('shared.nav')
        
    	<div class="container-fluid">
			
            {{-- @if(str_contains(Request::path(), 'auth')) if ($request->is('auth/*')) --}}
            
            <div class="blog-main">
                @yield('content')
            </div>
                
        </div><!-- container -->
    
    	@include('shared.footer')
    
    </div><!-- page -->
</body>
</html>
