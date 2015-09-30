
<div class="form-group imgArea">
{{-- <label>画像ドラッグ</label> --}}
    
    <div class="progBar"></div>
    
    <div class="clearfix">
    	<small>最初に画像の配置とサイズを選択して下さい</small>
        <label>画像配置</label>
        <select id="position" name="position">
        	<option value="center">中央</option>
            <option value="left">左寄せ</option>
            <option value="right">右寄せ</option>
        </select>
        &nbsp;&nbsp;&nbsp;

        <label>画像サイズ</label>
        <select id="size" name="size">
        	<option value="large">大</option>
            <option value="middle">中</option>
            <option value="small">小</option>
        </select>

        <button id="del_btn" class="btn btn-default pull-right">ドラッグした画像を削除</button>
    </div>

    <div id="dropArea" class="form-group">
        <span>追加する画像をここにドラッグして下さい…</span>
    </div>

    <div id="codeArea">
        下記に表示されるコードを、挿入したい場所にコピー&ペーストして下さい。
        <pre><code class="addCode"><?php //echo htmlspecialchars('<img src="images/" class="" />'."\n"); ?></code></pre>
    </div>


</div>
