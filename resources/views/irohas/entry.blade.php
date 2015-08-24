@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
        <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
        <li><a href="{{getUrl('iroha/study/'.$obj->id)}}">@if($obj->sub_title != ''){{$obj->sub_title}}
        @else{{$obj->title}}@endif</a></li>
        <li>お申し込み</li>
    </ul>
    
    <main class="page-ct study-entry">
    	<div class="main-head">
        	<h1 class="panel-head"><img src="/images/main/i-study.png">{{$obj->title}} 参加お申し込み</h1>
            <p></p>
        </div>
        
        @include('shared.move_1')
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>ご確認下さい！</strong><br /><br />
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        {!! Form::open(array(
            'class'=>'form-d',
            //'url' => '/confirm',
            //'action' => isset($obj) ? 'IrohaController@postEntry' : 'PageController@postContact',
        )) !!}
              
        <table class="table-d">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-7">
            </colgroup>
            
            <tbody>
                <tr>
                    <th>参加勉強会</th>
                    <td>
                        <label for="inputName" class="control-label">{{$obj->title}}</label>
                    </td>
                    {!! Form::hidden('study_name', $obj->title) !!}
                </tr>
          
                <tr>
                  <th>名前<em>必須</em></th>
                  <td>
                        {!! Form::input('text', 'name', old('name') != '' ? old('name') : Auth::user()->name, ['class' => 'form-control']) !!}
                  </td>
                </tr>

                <tr>
                    <th>メールアドレス<em>必須</em></th>
                    <td>
                      {!! Form::input('email', 'mail', old('mail') != '' ? old('mail') : Auth::user()->email, ['class' => 'form-control', 'id'=>'inputEmail']) !!}
                    </td>
                </tr>

                <tr>
                    <th>コメント<br /></th>
                    <td>
                        {!! Form::textarea('note', old('note') != '' ? old('note') : null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
              
              {{--
              <div class="form-group">
                  <label for="inputAddress" class="col-lg-3 control-label"></label>
                  <div class="col-lg-8">
                        <div class="checkbox">
                            <label>
                                {!! Form::input('checkbox', 'use_addr', isset($article) ? $article->plan : true, ['required']) !!}
                                個人情報の取り扱いに同意して送信する
                            </label>
                        </div>
                    </div>
                </div>
              --}}
             
              </tbody>
              </table> 

                <div>
                    {!! Form::hidden('iroha_id', $obj->id) !!}
                    {!! Form::hidden('user_id', Auth::user()->id) !!}
                    
                    <button type="submit" class="next-btn center-block">内容を確認する</button>
                    {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                </div>
          {!! Form::close() !!}

    </main>
@endsection
