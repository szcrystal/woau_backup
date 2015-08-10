<?php $s_info = DB::table('siteinfos')->first(); ?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    @if($s_info->seo_sw === 1)
<meta name="robots" content="index, follow">
    @else
<meta name="robots" content="noindex, nofollow">
    @endif
    
    {{-- DB::table('pages')->where('url_name',Request::path()) -> first() ->title --}}
<title><?php 
        if(isset($top)) {
            echo htmlspecialchars($top->sub_title." | ",ENT_QUOTES);
        }
        elseif(isset($pageObj)) {
           echo $pageObj-> title . ' | ';
        }

        ?>{{$s_info->site_name}}</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
	<!-- vector icon : octicon on github-->
    <link rel="stylesheet" href="{{ asset('/bootstrap/fonts/octicons/octicons.css') }}">

	<!-- Fonts -->
    {{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --}}
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Delius' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    
    {{--
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->

    <!-- Optional theme -->
    <link href="{{ asset('/bootstrap/css/bootswatch.css') }}" rel="stylesheet">
    @if (AdminAuth::user())
    <link href="{{ asset('/bootstrap/css/dashboard.css') }}" rel="stylesheet">
	@endif
    --}}
    
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{asset('/js/script.js') }}"></script>
    
    {{--
    <script src="{{ asset('/bootstrap/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/datepicker/locales/bootstrap-datepicker.ja.min.js') }}"></script>
    --}}
</head>

