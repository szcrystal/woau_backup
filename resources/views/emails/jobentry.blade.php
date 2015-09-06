<?php 
/* Here is mail view */
?>

{{-- for User --}}
@if($is_user)
{{$name}}　様
<br /><br />
{{--
{{$comp_name}}への応募が完了しました。
--}}
{!! nb($info->mail_jobentry) !!}

<br />
<br />

◆お名前：<br />
{{$name}}<br /><br />

◆メールアドレス：<br />
{{$mail}}<br /><br />

◆応募企業名：</strong><br />
{{$comp_name}} [ 案件No.{{$comp_number}} ]<br /><br />

◆コメント：<br />
{!! nl2br($note) !!}
<br /><br />

@if(isset($orgName))
◆添付ファイル名：<br />
{{$orgName}}
<br /><br /><br />
@endif

{!! nb($info->mail_footer) !!}
<br /><br />

{{-- for Administrator --}}
@else
{{$name}}さんより、案件の応募がありました。<br />
頂きました内容は下記となります。<br /><br />
◆名前：<br />
{{$name}} [ ユーザーNo:{{ $user_number }} ]<br /><br />

◆メールアドレス：<br />
{{$mail}}<br /><br />

◆企業名：<br />
{{$comp_name}} [ 案件No.{{$comp_number}} ]<br /><br />

◆コメント：<br />
{!! nl2br($note) !!}
<br /><br /><br />


@endif

<?php 
//	echo "あいうえお<br />"; 
//	
//    echo $name . "<br />" . $mail;
    
    //$pathToFile = 'images/RP21504_1012.jpg'; //http//localhost:5005は付けない 相対アドレスで。内部でfopen()してから$messageインスタンスにembedするらしい
    /*
    	<img src="<?php echo $message->embed($pathToFile); ?>">
    */
?>
{{--
<body>
    Here is an image:<br />

    Here is an image from raw data:<br />

    
</body>
--}}
