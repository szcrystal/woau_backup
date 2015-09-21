@extends('app')

	@section('content')
    
    		<a href="{{getUrl('blog')}}" class="btn btn-success">ブログへ戻る</a>
    	
        	<h2>{{$title}}</h2>
    
            @foreach($objs as $obj)
                <article>
                <?php 
                    if(isset($obj->img_link)) {
                        $link = $obj->img_link; 
                        $linkArr = explode(';', $link);
                    }
                    //echo $linkArr[0];
                ?>
                    <header>
                        <h1><a href="{{getUrl('blog/'.$obj->id)}}">{{ $obj->title}}</a></h1>

                        <small>{{getStrDate($obj->created_at)}}</small>
                    </header>
                    
                    {!! nb($obj -> intro_content) !!}

                    <div>
                    	{!! nb($obj -> main_content) !!}
                    </div>
                    
                    <footer>
                    {!! nb($obj -> sub_content) !!}
                    
                    {!! listCategory($obj->id); !!}

                    </footer>
                </article>
            
            @endforeach
            
            {!! $objs->render() !!}

    @endsection

