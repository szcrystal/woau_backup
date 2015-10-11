@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('recruit')}}">求人情報一覧</a></li>
        <li><a href="{{getUrl('recruit/job/'.$singleObj->job_number)}}">@if($singleObj->sub_title != ''){{$singleObj->sub_title}}
        @else{{$singleObj->company_name}}@endif</a></li>
        <li>案件に応募</li>
    </ul>

	<main class="page-ct job-entry">
    	<div class="main-head">
        	<h1>{{$singleObj -> company_name}} へ応募</h1>
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
            //'action' => 'PageController@postContact',
            //'enctype' => 'multipart/form-data',
            'files' => true,
        )) !!}
        
        <table class="table-d">
            <colgroup>
                <col class="cth">
                <col class="ctd">
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
                    <th>コメント</th>
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
                  
                </tbody>
            </table>
                  
            <div class="clearfix">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                    <input type="hidden" name="user_number" value="{{ Auth::user()->user_number }}" />
                    <input type="hidden" name="job_id" value="{{ $singleObj ->id }}" />
                    <input type="hidden" name="comp_number" value="{{ $singleObj ->job_number }}" />
                    <input type="hidden" name="comp_name" value="{{ $singleObj -> company_name }}" />
                    
                    <button type="submit" class="next-btn center-block">確認する</button>
                    {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
            </div>
            
        {!! Form::close() !!}

	</main>
@endsection
