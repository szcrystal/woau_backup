@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>お問い合わせ（内容確認）</li>
    </ul>
    
    <main class="page-ct contact">
    	<div class="main-head">
        	<h1>お問い合わせ</h1>
            <p></p>
        </div>
        
        @include('shared.move_2')
                          
        <table class="table-d">
            <colgroup>
            	<col class="cth">
            	<col class="ctd">
            </colgroup>

            <tbody>

            <tr> 
                <th scope="row">名前</th>
                <td>{{$datas['name']}}</td>
            </tr>
            <tr> 
                <th scope="row">メールアドレス</th>
                <td>{{$datas['mail']}}</td>
            </tr>
            <tr> 
                <th scope="row">コメント</th>
                <td>{!! nb($datas['note']) !!}</td>
            </tr>

            </tbody>
        </table>
        
        	{{--
            @foreach($datas as $key => $val)
                @if($key != '_token')   
                        <dt style="background-color:#eee;">{{$key}}</dt>
                        <dd style="background-color:#fff;">{{$val}}</dd>

                @endif
            @endforeach
            --}}
        
            {!! Form::open(array( 
            				'method' => 'post',
                            'action'=>'PageController@postContact' 
                        )) !!} {{-- 'url'=>'/finish' --}}
            
            	@foreach($datas as $key => $val) 
                    @if($key != '_token')
                        {!! Form::hidden($key, $val) !!}
                    @endif
                @endforeach
            	
                {!! Form::hidden('end', TRUE) !!}
                
                <div class="wrap-b">
                {!! Form::submit('送 信', array('class'=>'next-btn', 'name' => '_apply')) !!}
                {!! Form::submit('戻 る', ['class'=>'back-btn', 'name'=>'_return']) !!}
                </div>
                
                {{-- <a href="{{getUrl('contact')}}" class="btn btn-default">戻 る</a> --}}
                {{-- ,'onclick'=>'history.back(); return false;' --}}
                
            {!! Form::close() !!}
            
	</main>
@endsection
