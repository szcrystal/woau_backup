<div id="secondary">
	<aside>
        <h3><span class="octicon octicon-tag"></span>新着求人</h3>
        <ul>
        	<?php $c_objs = DB::table('jobs')->orderBy('created_at', 'desc')->take(5)->get(); ?>
            
            @foreach($c_objs as $obj)
                <li><a href="{{ getUrl('blog/'.$obj->id) }}">{{ $obj->title }}</a></li>
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
        <?php $b_objs = DB::table('cates')->orderBy('created_at', 'desc')->get(); ?>
            
        @foreach($b_objs as $obj)
            <li><a href="{{ getUrl('blog/category/'.$obj->slug) }}">{{ $obj->c_name }}</a></li>
        @endforeach
        
        </ul>
    </aside>
    
    <aside>
        <h3><span class="octicon octicon-tag"></span>Archive</h3>
    </aside>
    
    <aside>
        <h3><span class="octicon octicon-tag"></span>監査役について</h3>
        <ul>
        <?php $irohas = App\Iroha::where('slug', 'irohas') -> get(); ?>
        
        @foreach($irohas as $iroha)
        	<li><a href="{{getUrl('iroha/'.$iroha->url_name)}}">{{ $iroha->sub_title }}</a></li>
        @endforeach
        
        <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
        </ul>
    </aside>
    
    <aside>
        <h3><span class="octicon octicon-tag"></span>勉強会</h3>
        <ul>
        <?php $irohas = App\Iroha::where('slug', 'study') -> orderBy('created_at', 'desc')-> take(5) -> get(); ?>
        
        @foreach($irohas as $iroha)
        	<li><a href="{{getUrl('iroha/study/'.$iroha->id)}}">{{ $iroha->title }}</a></li>
        @endforeach
        </ul>
    </aside>
</div>
