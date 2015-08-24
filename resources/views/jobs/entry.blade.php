@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('recruit')}}">求人情報一覧</a></li>
        <li><a href="{{getUrl('recruit/job/'.$singleObj->job_number)}}">@if($singleObj->sub_title != ''){{$singleObj->sub_title}}
        @else{{$singleObj->title}}@endif</a></li>
        <li>応募</li>
    </ul>

	<main class="page-ct job-entry">
    	<div class="main-head">
        	<h1 class="panel-head"><img src="/images/main/i-job.png">{{$singleObj -> company_name}}へ応募する</h1>
            <p>説明や注意事項等あればここに記載</p>
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
            //'action' => 'PageController@postContact',
            //'enctype' => 'multipart/form-data',
            'files' => true,
        )) !!}
        
        <table class="table-d">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-7">
            </colgroup>
            
            <tbody>
                <tr>
                    <th>応募企業</ht>
                    <td>
                       {{$singleObj -> company_name}}
                    </td>
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
                    <th>コメント<br />{{--<span>（1000文字以内）</span>--}}</th>
                    <td>
                        {!! Form::textarea('note', old('note') !='' ? old('note') : null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                  
                <tr>
                    <th>添付ファイル</th>
                    <td>
                        {!! Form::input('file', 'add_file', old('add_file'), ['class' => 'form-control']) !!}
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
                  
            <div class="clearfix">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                    <input type="hidden" name="user_number" value="{{ Auth::user()->user_number }}" />
                    <input type="hidden" name="job_id" value="{{ $singleObj ->id }}" />
                    <input type="hidden" name="comp_number" value="{{ $singleObj ->job_number }}" />
                    <input type="hidden" name="comp_name" value="{{ $singleObj -> company_name }}" />
                    
                    <button type="submit" class="next-btn center-block">内容を確認する</button>
                    {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
            </div>
            
        {!! Form::close() !!}

	</main>
@endsection
