<div id="secondary">
	<aside>
        <h3><span class="octicon octicon-tag"></span>新着求人</h3>
        <ul>
        	<?php $c_objs = DB::table('jobs')->where('closed','公開中')->orderBy('created_at', 'desc')->take(5)->get(); ?>
            
            @foreach($c_objs as $obj)
                <li><a href="{{ getUrl('recruit/job/'.$obj->job_number) }}">{{ $obj->sub_title }}</a></li>
            @endforeach
        </ul>
    
    </aside>
    <aside>
        <h3><span class="octicon octicon-tag"></span>最近のブログ</h3>
        <ul>
        	<?php $b_objs = DB::table('blogs')->orderBy('created_at', 'desc')->take(5)->get(); ?>
            
            @foreach($b_objs as $obj)
                <li><a href="{{ getUrl('blog/'.$obj->id) }}">{{ $obj->title }}</a></li>
            @endforeach
        </ul>
    
    </aside>
    
    
    
    <aside>
        <h3><span class="octicon octicon-tag"></span>カテゴリー</h3>
        <ul>
        <?php //$rels = DB::table('cate_relations')->get();
        
        //DB::table('cates')->orderBy('created_at', 'desc')->get(); 
        $cates = DB::table('cates')->orderBy('created_at', 'desc')->get(); 
        
        
        ?>
            
        @foreach($cates as $cate)
        	<?php 
            	$rel = DB::table('cate_relations')->where('cate_id',$cate->id)->first();
                if(isset($rel)) {
            	$obj = DB::table('cates') -> find($rel->cate_id);
            ?>
            	<li><a href="{{ getUrl('blog/category/'.$obj->slug) }}">{{ $obj->c_name }}</a></li>
                <?php } ?>
        @endforeach
        
        </ul>
    </aside>
    
    {{--
    <aside>
        <h3><span class="octicon octicon-tag"></span>Archive</h3>
    </aside>
    --}}
    
    <aside>
        <h3><span class="octicon octicon-tag"></span>監査役について</h3>
        <ul>
        <?php $irohas = App\Iroha::where(['slug'=>'irohas', 'closed'=>'公開中']) -> get(); ?>
        
        @foreach($irohas as $iroha)
        	<li><a href="{{getUrl('iroha/'.$iroha->id)}}">{{ $iroha->sub_title }}</a></li>
        @endforeach
        
        <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
        </ul>
    </aside>
    
    <aside>
        <h3><span class="octicon octicon-tag"></span>勉強会</h3>
        <ul>
        <?php $irohas = App\Iroha::where(['slug'=>'study', 'closed'=>'公開中']) -> orderBy('created_at', 'desc')-> take(5) -> get(); ?>
        
        @foreach($irohas as $iroha)
        	<li><a href="{{getUrl('iroha/study/'.$iroha->id)}}">{{ $iroha->title }}</a></li>
        @endforeach
        </ul>
    </aside>
</div>
