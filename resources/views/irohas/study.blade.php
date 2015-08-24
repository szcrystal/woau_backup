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
            
                <article class="archive">
                <?php 
                    if(isset($obj->img_link)) {
                        $link = $obj->img_link; 
                        $linkArr = explode(';', $link);
                    }
                    //echo $linkArr[0];
                ?>
                    <header>
                        <small>{!! getStrDate($obj->created_at, 'slash') !!}</small>
                        <h2><a href="{{getUrl('/iroha/study/'.$obj->id)}}">{{ $obj->title}}</a></h2>
                    </header>
                    
                    <div>
                        @if($obj -> intro_content != '')
                            {!! $obj -> intro_content !!}
                        @else
                            {!! mb_substr(strip_tags($obj -> main_content), 0, 100) !!}
                        @endif
                        <a href="{{ getUrl('/iroha/study/'.$obj->id) }}" class="dots">・・・</a><br>
                        <a href="{{ getUrl('/iroha/study/'.$obj->id) }}" class="more">Read More »</a>
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

