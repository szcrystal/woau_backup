<div class="form-group imgArea-job">
    {{-- <label>画像ドラッグ</label> --}}

    <div class="progBar"></div>

    <div class="clearfix">
        <label class="pull-left">企業ロゴ画像</label>
        @if(isset($article) && $article->img_link != '')
        <button id="preDel_btn" class="btn btn-warning pull-left">画像を削除</button>
        @endif
        <button id="del_btn" class="btn btn-default pull-right">ドラッグした画像を削除</button>
        
    </div>

	<div id="dropAreaJob">
    	@if(isset($article))
            @if($article->img_link == '' || $article->img_link === null)
                <span>Drag & Drop Here…<br>
                画像サイズを横幅220pxもしくはそれ以上にすると綺麗に出力されます。</span>
            @else
            
            <?php $imgArrs = explode(';', $article->img_link); 
                //Laravel function : $imgArrs = array_reverse($imgArrs);
            ?>
            
                @foreach($imgArrs as $imgArr)
                    <img src="{{$imgArr}}" class="preImg addImg" />
                @endforeach
            
            @endif
        @else
            <span>Drag & Drop Here…<br>
                画像サイズを横幅220pxもしくはそれ以上にすると綺麗に出力されます。</span>
        @endif
    </div>

</div>
