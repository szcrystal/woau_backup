@extends('app')

@section('content')

	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        @if(isset($userObj))
        <li><a href="{{getUrl('profile/'.$userObj->user_number)}}">ユーザー情報</a></li>
        @endif
        <li>{{$headTitle}}</li>
    </ul>

    <main class="page-ct register">
    	<div class="main-head">
        	<h1>{{$headTitle}}</h1>
            @if(! isset($userObj))
            <p>登録後は、案件や勉強会一覧のページなどが閲覧可能となります。登録された情報は応募申込みに必要となります。</p>
            @else
            <p>{{$userObj->name}}さんのユーザー情報を編集します。<br>パスワードを変更する場合は新しいパスワードを入力し、変更しない場合は未入力のまま次へお進み下さい。</p>
            @endif
        </div>
        
        @if(! isset($userObj))
        	@include('shared.move_1')
        @endif
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <span class="octicon octicon-alert"></span><strong>ご確認ください</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(array('class'=>'form-d')) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
            <table class="table-d">
                <colgroup>
                    <col class="cth">
                    <col class="ctd">
                </colgroup>
                
                <tbody>
                    <tr>
                        <th>名前<em>必須</em></th>
                        <td>
                            {!! Form::input('text', 'name', isset($userObj) ? $userObj->name : old('name'), ['class' => 'form-control']) !!}
                        </td> 
                    </tr>
                    <tr>
                        <th>メールアドレス<em>必須</em></th>
                        <td>
                            {!! Form::input('email', 'email', isset($userObj) ? $userObj->email : old('email'), ['class' => 'form-control']) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード（6文字以上）<em>必須</em>
                            @if(isset($userObj))
                                <br /><small>※未入力の場合は変更しません</small>
                            @endif
                        </th>
                        <td>
                            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder'=>'6文字以上を入力して下さい']) !!}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>パスワード（確認用）<em>必須</em></th>
                        <td>
                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>生年月日</th>
                        <td>
                            @if(Auth::user())
                                <?php
                                    $birth = explode('-', $userObj->birth);
                                ?>
                                <select name="birth_year">
                                    <?php selectBox(2015, 1900, $birth[0]); ?>
                                </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">年</span>
                                <select name="birth_month">
                                    <?php selectBox(1, 12, $birth[1]); ?>
                                </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">月</span>
                                <select name="birth_day">
                                    <?php selectBox(1, 31, $birth[2]); ?>
                                </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">日</span>
                                
                                {{--
                                {!! Form::input('text', 'birth_year', isset($birth[0]) ? $birth[0] : old('birth_year'), ['class' => 'form-control']) !!}<span>年</span>
                                
                                {!! Form::input('text', 'birth_month', isset($birth[1]) ? $birth[1] : old('birth_month'), ['class' => 'form-control']) !!}<span>月</span>
                                {!! Form::input('text', 'birth_day', isset($birth[2]) ? $birth[2] : old('birth_day'), ['class' => 'form-control']) !!}<span>日</span>
                                --}}
                            @else
                                <select name="birth_year">
                                    <?php selectBox(2015, 1900, old('birth_year')); ?>
                                    
                                </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">年</span>
                                <select name="birth_month">
                                    <?php selectBox(1, 12, old('birth_month')); ?>
                                </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">月</span>
                                <select name="birth_day">
                                    <?php selectBox(1, 31, old('birth_day')); ?>
                                </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">日</span>
                            
                            {{--
                                {!! Form::selectRange('birth_year', 2015, 1900, null ) !!}<span style="margin:3px 2px 0; font-size:0.8em;">年</span>
                                {!! Form::selectRange('birth_month', 1, 12) !!}<span>月</span>
                                {!! Form::selectRange('birth_day', 1, 31) !!}<span>日</span>
                                <select>
                                {{ selectBox(2015, 1900); }}
                                </select>
                            --}}
                            
                            @endif
                        </td>
                    </tr>
                        
                    <tr>
                        <th>所在地（住所）<br>（例：東京都○○区）</th>
                        <td>    
                            {!! Form::input('text', 'address', isset($userObj) ? $userObj->address : old('address'), ['class' => 'form-control', 'placeholder'=>'例：東京都○○区']) !!}
                        </td>
                    </tr>
                        
                    <tr>
                        <th>職歴<br>（現在までの職歴、部署、役職等）</th>
                        <td>
                            {!! Form::textarea('work_history', isset($userObj) ? $userObj->work_history : old('work_history'), ['class'=>'form-control','rows' => 15, 'placeholder' => '現在までの職歴、部署、役職等']) !!}
                        </td>
                    </tr>
                    
                    {{--
                    <tr>
                        <th>役職</th>
                        <td>
                            {!! Form::textarea('office_posi', isset($userObj) ? $userObj->office_posi : old('office_posi'), ['class'=>'form-control','rows' => 15]) !!}
                        </td>
                    </tr>
                    --}}
                    
                    <tr>
                        <th>出張の可否</th>
                        <?php
                            function trip($obj, $arg) {
                                //return $obj->is_trip;
                                if(isset($obj)) {
                                    return ($obj->is_trip == $arg) ? true : null;
                                }
                                else {
                                    if($arg == '出張可能')
                                        return true;
                                }
                            }
                            
                            function is_sess($sessArg, $str) {
                                if($sessArg == '') { //初回表示時
                                     if($str == '出張可能') return true;
                                }
                                else { //初期以外（sessionに可・不可のどちらかがセットされている）
                                    if($sessArg==$str) return true;
                                }
                            }
                        ?>
                        <td>
                        <span class="wrap-radio">
                        {!! Form::radio('is_trip', '出張可能', isset($userObj)? trip($userObj, '出張可能'): is_sess(old('is_trip'),'出張可能'), array('id'=>'yes')) !!}<label for="yes">可</label>
                        
                        {!! Form::radio('is_trip', '出張不可', isset($userObj)? trip($userObj, '出張不可'): is_sess(old('is_trip'),'出張不可'), array('id'=>'no')) !!}<label for="no">不可</label>
                        </span>
                        
                        </td>
                    </tr>
                        
                    <tr>
                        <th>英語能力</th>
                        <td>
                            {!! Form::input('text', 'eng_ability', isset($userObj) ? $userObj->eng_ability : old('eng_ability'), ['class' => 'form-control']) !!}
                        </td>
                    </tr>
                        
                    <tr>
                        <th>公認会計士資格取得年</th>
                        <td>
                            <select name="get_year">
                                @if( Auth::user() && isset($userObj) )
                                {!! selectBox(2015, 1900, $userObj->get_year) !!}
                                @else
                                {!! selectBox(2015, 1900, old('get_year')) !!}
                                @endif
                            </select><span class="t-down"></span><span style="margin:3px 5px 0 3px; color:#555;">年</span>
                        {{--
                            {!! Form::selectRange('get_year', 2015, 1900) !!}年
                        --}}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>過去の経験監査業種</th>
                        <td>
                            {!! Form::textarea('exp_type', isset($userObj) ? $userObj->exp_type : old('exp_type'), ['class'=>'form-control','rows' => 15]) !!}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>監査時のポジション<br>（例：主任2社、現場主任1社）</th>
                        <td>
                            {!! Form::textarea('audit_posi', isset($userObj) ? $userObj->audit_posi : old('audit_posi'), ['class'=>'form-control','rows' => 15, 'placeholder'=>'例：主任2社、現場主任1社']) !!}
                        </td>
                    </tr>

                                        
                </tbody>
            </table>
                
            <button type="submit" class="next-btn center-block">
                @if(isset($userObj))
                変更する
                @else
                確認する
                @endif
            </button>
            
        {!! Form::close() !!}
        
        @if(isset($userObj))
            <a href="{{getUrl('profile/'.$userObj->user_number)}}" class="back-tx">ユーザー情報へ戻る</a>
        @endif
				
    </main>

@endsection
