<?php $info = DB::table('siteinfos') -> first(); ?>

{{ $name }} 様
{{--
{{ $info->site_name }}です。
--}}
<br /><br />

▼パスワードリセット用のリンクは下記となります。<br />

{{ url('password/reset/'. $token) }}
<br /><br />

2時間以内に、クリックをしてパスワードリセットの手続きを進めて下さい。<br /><br />
有効時間を過ぎますと上記のリンクは無効となります。<br />
その場合は再度手続きをやり直して下さい。

<br /><br /><br />


{!! nl2br($info->mail_footer) !!}
<br /><br />
