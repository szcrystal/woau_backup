
@if(isset($article))
    @if($article->img_link == '' || $article->img_link === null)
        <span>追加する画像をここにドラッグして下さい…</span>
    
    @else
    <?php 
        $imgArrs = explode(';', $article->img_link); 
        //$imgArrs = array_reverse($imgArrs);
    ?>
        @foreach($imgArrs as $imgArr)
            <img src="{{$imgArr}}" class="preImg addImg" />
        @endforeach
    
    @endif
@else
    <span>追加する画像をここにドラッグして下さい…</span>
@endif
    

