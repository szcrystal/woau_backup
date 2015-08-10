@extends('app')

    @section('content')
    <div class="contact">
        <h2 class="panel-head"><img src="/images/main/i-mail.png">お問い合わせ</h2>
        
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
                {!! Form::submit('送 信', array('class'=>'send-btn pull-left', 'name' => '_apply')) !!}
                {!! Form::submit('戻 る', ['class'=>'back-btn pull-right', 'name'=>'_return']) !!}
                </div>
                
                {{-- <a href="{{getUrl('contact')}}" class="btn btn-default">戻 る</a> --}}
                {{-- ,'onclick'=>'history.back(); return false;' --}}
                
            {!! Form::close() !!}
            
{{--
        {!! Form::open(array( 'url' => 'reservation/finish', 'method' => 'post' )) !!}
              {!! Form::hidden('name', $datas['name']) !!}
              {!! Form::hidden('mail', $datas['mail']) !!}
              {!! Form::hidden('address', $datas['address']) !!}
              {!! Form::hidden('use_addr', $datas['use_addr']) !!}
              {!! Form::hidden('note', $datas['note']) !!}
          	{!! Form::submit('apply', array('class'=>'btn btn-primary', 'name' => '_apply')) !!}
			{!! Form::submit('return', array('class'=>'btn btn btn-warning', 'name' => '_return')) !!}
      	{!! Form::close() !!}
--}}
	</div>
    @endsection
