@extends('app')

@section('content')
    

    	<article class="page-ct error404">
        	<h1 class="main-title">エラー：404</h1>
            <div style="text-align:center;">
            	<img src="{{asset('images/main/il-comp.png')}}">
                <p style="margin: 2em 0; font-size: 1.05em;">お探しのページがありませんでした。<br><a href="{{getUrl('/')}}">TOPページ</a>に戻り、再度リンクなどよりお入り直し下さい。</p>
                <a href="{{getUrl('/')}}" class="edit-btn">TOPへ</a>
            </div>
        </article>

@endsection
