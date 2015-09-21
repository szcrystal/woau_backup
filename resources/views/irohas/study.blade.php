@extends('app')

	@section('content')
    
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
            <li>勉強会一覧</li>
        </ul>
    
        <div class="page-ct study">
            <div class="main-head clearfix">
                <h1>勉強会一覧</h1>
                <p>監査役になるための基礎知識を身につけたり<br>監査する上での注意点を学んだりするのが目的です。</p>
                
                {!! $objs->render() !!}
            </div>
            
            @foreach($objs as $obj)
            	<?php $path = Request::path() .'/'. $obj->id; ?>
            
                <article class="archive">
                    <header>
                        <small>{!! getStrDate($obj->created_at, 'slash') !!}</small>
                        <h2><a href="{{getUrl($path)}}">{{ $obj->title}}</a></h2>
                    </header>
                    
                    <div>
                    	@if($obj -> intro_content != '')
                            {!! readMoreContents($obj->intro_content, $path) !!}
                        @else
                            {!! readMoreContents($obj->main_content, $path) !!}
                        @endif
                        
                    </div>
                    
                    {{--
                    <footer>
                    {!! nb($obj -> sub_content) !!}
                    </footer>
                    --}}
                    
                </article>
            @endforeach
            
            {!! $objs->render() !!}
        
        </div>
 
    @endsection

