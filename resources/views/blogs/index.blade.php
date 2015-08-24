@extends('app')

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>ブログ</li>
        </ul>
    
    	<main class="page-ct blog">
        	<div class="main-head">
                <h1>
                @if(isset($title))
                {{ $title }}
                @else
                管理者ブログ
                @endif
                </h1>
            	<p>woman x auditorの管理者のブログ</p>
            </div>
            
            <div id="primary">
            	<div class="clearfix">
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
                        <h2><a href="{{getUrl('blog/'.$obj->id)}}">{{ $obj->title}}</a></h2>
                    </header>
                    
                    <div>
                    @if($obj -> intro_content != '')
                    	{!! $obj -> intro_content !!}
                    @else
                    	{!! mb_substr(strip_tags($obj -> main_content), 0, 100) !!}
                    @endif
                    <a href="{{ getUrl('blog/'.$obj->id) }}" class="dots">・・・</a><br>
                    <a href="{{ getUrl('blog/'.$obj->id) }}" class="more">Read More »</a>
                    
                    </div>
                    
                    <footer>
                    {!! nb($obj -> sub_content) !!}
                    
                    {{--
                    @if( ! App\Blog::find($obj->id)->cateRelation ->isEmpty())
                    --}}
                    
                    @if( ! $obj->cateRelation ->isEmpty())
                        <ul class="clearfix">
                            <li>カテゴリー<li>
                        <?php 
                        	$cates = $obj->cateRelation;
                            $format = "<li class=\"pull-left\"><a href=\"%s\">%s</a>%s</li>\n"; 
                            foreach($cates as $cate) {
                                $cateObj = App\Cate::find($cate->cate_id);
                                printf($format, getUrl('blog/category/'.$cateObj->slug), $cateObj->c_name, ($cates->last() == $cate) ? "": ",&nbsp&nbsp;" );
                            }
                        ?>

                        </ul>
                    @endif
                    </footer>
                    
                </article>
            
            @endforeach
            
            {!! $objs->render() !!}
            
        </div>
        
        @include('shared.sidebar')

        
    </main>
  
    @endsection

