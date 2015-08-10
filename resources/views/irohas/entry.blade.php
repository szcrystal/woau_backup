@extends('app')

@section('content')
<div class="study-entry">
	<h2 class="panel-head"><img src="/images/main/i-study.png">{{$obj->title}} 参加お申し込み</h2>
    
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
        'class'=>'form−d',
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
	              	
                    <button type="submit" class="send-btn center-block">内容を確認する</button>
                	{{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                </div>
          {!! Form::close() !!}

<!--
		<div class="col-lg-6">
		<div class="well bs-component">

        <form class="form-horizontal">
        <fieldset>
        <legend>Legend</legend>

        <div class="form-group">
        	<label for="inputEmail" class="col-lg-2 control-label">Email</label>
        	<div class="col-lg-10">
        		<input type="text" class="form-control" id="inputEmail" placeholder="Email">
        	</div>
        </div>

        <div class="form-group">
        	<label for="inputPassword" class="col-lg-2 control-label">Password</label>
        	<div class="col-lg-10">
        		<input type="password" class="form-control" id="inputPassword" placeholder="Password">
        		<div class="checkbox">
        			<label>
        				<input type="checkbox"> Checkbox
        			</label>
        		</div>
        	</div>
        </div>

        <div class="form-group">
        	<label for="textArea" class="col-lg-2 control-label">Textarea</label>
        	<div class="col-lg-10">
        		<textarea class="form-control" rows="3" id="textArea"></textarea>
        		<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
        	</div>
        </div>

        <div class="form-group">
        <label class="col-lg-2 control-label">Radios</label>
        <div class="col-lg-10">
        <div class="radio">
        <label>
        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
        Option one is this
        </label>
        </div>
        <div class="radio">
        <label>
        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
        Option two can be something else
        </label>
        </div>
        </div>
        </div>
        <div class="form-group">
        <label for="select" class="col-lg-2 control-label">Selects</label>
        <div class="col-lg-10">
        <select class="form-control" id="select">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select>
        <br>
        <select multiple="" class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select>
        </div>
        </div>
        <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
        </fieldset>
        </form>

        </div>
        </div>
-->
</div>
@endsection
