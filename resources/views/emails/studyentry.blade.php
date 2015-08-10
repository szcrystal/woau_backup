<?php 
/* Here is mail view */
?>

{{-- for User --}}
@if($is_user)
{{$name}}　様
<br /><br />

{!! nb($info->mail_jobentry) !!}

<br />
<br />
<br />

◆お名前：<br />
{{$name}}<br /><br />

◆メールアドレス：<br />
{{$mail}}<br /><br />

◆参加勉強会：</strong><br />
{{$study_name}} [ No.{{$iroha_id}} ]<br /><br />

◆コメント：<br />
{!! nl2br($note) !!}
<br /><br /><br />

{!! nb($info->mail_footer) !!}


{{-- for Administrator --}}
@else
{{$name}}さんより、勉強会への参加申し込みがありました。<br />
頂きました内容は下記となります。<br /><br />
◆名前：<br />
{{$name}} [ ID:{{ $user_id }} ]<br /><br />

◆メールアドレス：<br />
{{$mail}}<br /><br />

◆参加勉強会：</strong><br />
{{$study_name}} [ No.{{$iroha_id}} ]<br /><br />

◆コメント：<br />
{!! nl2br($note) !!}
<br /><br /><br />

{!! nb($info->mail_footer) !!}

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
