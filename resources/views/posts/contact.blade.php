@extends('app')

@section('content')
	<h2 class="page-header">お問い合わせフォーム</h2>
    
    	@if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (count($errors)==0)
        	<div class="alert">
        		<p style="color:orange;"><strong>Save is done</strong></p>
                <a href="/dashboard">一覧ページへ »</a>
            </div>
        @endif


    <div>{{-- col-lg-8 --}}
		<div class="well bs-component">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
      
          {!! Form::open(array(
          					'class'=>'form-horizontal',
                            //'url' => '/confirm',
                            'action' => 'PostsController@postContact',
                        )) !!}
          
              <div class="form-group">
                  <label for="inputName" class="col-lg-2 control-label">お名前</label>
                  <div class="col-lg-10">
                        {!! Form::input('text', 'name', old('name'), ['required', 'class' => 'form-control']) !!}
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">メール</label>
                    <div class="col-lg-10">
                      {!! Form::input('text', 'mail', old('mail_add'), ['required', 'class' => 'form-control', 'id'=>'inputEmail']) !!}
                    </div>
              </div>

              

              <div class="form-group">
                  <label for="textarea" class="col-lg-2 control-label">お問い合わせ内容（・・文字以内）</label>
                  <div class="col-lg-10">
                    {!! Form::textarea('note', isset($article) ? $article->note : null, ['required', 'class' => 'form-control']) !!}
                </div>
              </div>
              
              <div class="form-group">
                  <label for="inputAddress" class="col-lg-2 control-label">個人情報の取り扱いに同意して送信する</label>
                  <div class="col-lg-10">
                        <div class="checkbox">
                            <label>
                                {!! Form::input('checkbox', 'use_addr', isset($article) ? $article->plan : true, ['required']) !!}
                                個人情報の取り扱いに同意して送信する
                            </label>
                        </div>
                    </div>
            	</div>
              
              
              <div class="row">
              	<div class="pull-right">
	              	<button type="submit" class="btn btn-primary">確認する</button>
                	<button type="reset" class="btn btn-default">Reset</button>
                </div>
            </div>
          {!! Form::close() !!}

      </div>
      </div>

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
@endsection
