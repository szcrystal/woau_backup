<?php $sg = isset($article) ? $article->slug : $slug; ?>

<div class="checkbox">
    @if(isset($article) && $sg == 'pages' && DB::table('siteinfos')->first()->top_id == $article->id)
    	<small>　※このページはTOPページです。公開状態の変更は出来ません</small>
    @else
        <label>
        {!! Form::checkbox('closed', '非公開', (isset($article) && $article->closed == '非公開') ? true : false, []) !!}
        このページを非公開にする
        </label><br>
        <small>変更後は更新ボタンを押して下さい</small>
    @endif
</div>

@if(isset($article) && $article->closed == '非公開')
    <p><span class="octicon octicon-issue-opened"></span>このページは非公開です。</p>
@endif

<div class="form-group">
    <label>日付<em>（必須）</em></label>
    <?php 
    $past = isset($article) ? strtotime($article->created_at) : time(); 
    //$past = getdate($past); 
    ?>
    {!! Form::input('text', 'date_y', date('Y', $past), ['class' => 'date form-control']) !!}年
    {!! Form::input('text', 'date_m', date('n', $past), ['class' => 'date form-control']) !!}月
    {!! Form::input('text', 'date_d', date('j', $past), ['class' => 'date form-control']) !!}日
</div>

@if($sg == 'jobs') {{-- @if(str_contains(Request::path(), 'auth')) --}}
    <div class="form-group">
        <label>企業名<em>（必須）</em></label>
        {!! Form::input('text', 'company_name', isset($article) ? $article->company_name : null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>タイトルフレーズ</label>
        {!! Form::input('text', 'title', isset($article) ? $article->title : null, ['class' => 'form-control']) !!}
    </div>
@else
    <div class="form-group">
        <label>タイトル<em>（必須）</em></label>
        {!! Form::input('text', 'title', isset($article) ? $article->title : null, ['class' => 'form-control']) !!}
    </div>
@endif

<div class="form-group">
    <label>サブタイトル<em>（必須：リンク名の表示に使用されます。コンテンツ内には表示されません。）</em></label>
    {!! Form::input('text', 'sub_title', isset($article) ? $article->sub_title : null, ['class' => 'form-control']) !!}
</div>
