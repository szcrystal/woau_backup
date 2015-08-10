
<div class="form-group imgArea">
{{-- <label>画像ドラッグ</label> --}}

<div id="progBar"></div>

<div class="clearfix">
    <label>画像配置</label>
    <select id="position" name="position">
        <option value="left">左寄せ</option>
        <option value="center">中央</option>
        <option value="right">右寄せ</option>
    </select>&nbsp;&nbsp;&nbsp;

    <label>画像サイズ</label>
    <select id="size" name="size">
        <option value="large">大</option>
        <option value="middle">中</option>
        <option value="small">小</option>
    </select>

    <button id="del_btn" class="btn btn-default pull-right">追加した画像を削除</button>
</div>

<div id="dropArea" class="form-group">
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
    
</div>

<div id="codeArea">
    下記に表示されるコードを、挿入したい場所にコピー&ペーストして下さい。
    <pre><code class="addCode"><?php //echo htmlspecialchars('<img src="images/" class="" />'."\n"); ?></code></pre>
</div>

</div>
