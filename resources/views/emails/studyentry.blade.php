<?php 
/* Here is mail view */
?>

{{-- for User --}}
@if($is_user)
{{$name}}　様
<br /><br />

{!! nb($info->mail_jobentry) !!}

<br />
………………………………………………………………………………………
<br /><br />

◆勉強会名</strong><br />
{{$study_name}}<br /><br />

◆お名前<br />
{{$name}}<br /><br />

◆メールアドレス<br />
{{$mail}}<br /><br />


◆コメント<br />
{!! nl2br($note) !!}
<br /><br /><br />

{!! nb($info->mail_footer) !!}


{{-- for Administrator --}}
@else
{{$name}}さんより、勉強会への参加申し込みがありました。<br />
頂きました内容は下記となります。<br />

<br />
………………………………………………………………………………………
<br /><br />

◆名前<br />
{{$name}} [ ユーザーNo:{{ $user_number }} ]<br /><br />

◆メールアドレス<br />
{{$mail}}<br /><br />

◆参加勉強会</strong><br />
{{$study_name}} [ No.{{$iroha_id}} ]<br /><br />

◆コメント<br />
{!! nl2br($note) !!}
<br /><br /><br /><br /><br />


{!! nb($info->mail_footer) !!}
<br /><br />

@endif
