<?php 
/* Here is mail view */
?>

<?php //$info = DB::table('siteinfos')->first(); ?>

@if($is_user)
{{$name}}　様
<br /><br />
{!! nb($info->mail_contact) !!}

<br />
………………………………………………………………………………………
<br /><br />

◆お名前：<br />
{{$name}}<br /><br />

◆メールアドレス：<br />
{{$mail}}<br /><br />

◆お問い合わせ内容：<br />
{!! nl2br($note) !!}
<br /><br /><br /><br />

{!! nb($info->mail_footer) !!}
<br /><br />

@else
{{$name}}様より、お問い合わせがありました。<br />
頂きました内容は下記となります。<br />

<br />
………………………………………………………………………………………
<br /><br />

◆お名前：<br />
{{$name}}<br /><br />

◆メールアドレス：<br />
{{$mail}}<br /><br />

◆お問い合わせ内容：<br />
{!! nl2br($note) !!}
<br /><br /><br /><br />


{!! nb($info->mail_footer) !!}

<br /><br />

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
