@extends('app')

	@section('content')
    	
    
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

                    {!! nb($obj -> main_content) !!}
                    
                    <footer>
                    {!! nb($obj -> sub_content) !!}
                    
                    <?php
                    	
                        if( $cates = App\Blog::find($obj->id)->cateRelation )
                        {
                        	echo '<ul style="list-style:none; border: 1px solid #ddd;" class="clearfix">';
                            foreach($cates as $cate) {
                                $cateObj = App\Cate::find($cate->cate_id);
                                
                                echo '<li class="pull-left"><a href="blog/category/'.$cateObj->slug.'">'. $cateObj->name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        
                    ?>
                    
                    </footer>
                </article>
            
            @endforeach
            
            <?php echo $objs->render(); ?>
        

  
    @endsection

