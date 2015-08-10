@extends('app')

    @section('content')
        <h2 class="page-header">お問い合わせ内容確認</h2>
        
        	<div class="table-responsive">
				<dl>
          
    			<?php echo "SESSION: " . session('del_key'); ?>
        
            @foreach($datas as $key => $val)
                @if($key != '_token')   
                        <dt style="background-color:#eee;">{{$key}}</dt>
                        <dd style="background-color:#fff;">{{$val}}</dd>

                @endif
            @endforeach
            
       			</dl>
        	</div>
        

                
            
            {!! Form::open(array( 'method' => 'post', 'url'=>'/finish' )) !!}
            
            	@foreach($datas as $key => $val) 
                    @if($key != '_token')
                        {!! Form::hidden($key, $val) !!}
                    @endif
                @endforeach
            
                {!! Form::submit('apply', array('class'=>'btn btn-primary', 'name' => '_apply')) !!}
				{!! Form::submit('return', array('class'=>'btn btn btn-warning', 'name' => '_return')) !!}
            
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

    @endsection
