<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('page-title') | {{ settings('app_name') }}</title>

<meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

{{ HTML::style('spcvn/css/bootstrap.min.css') }}
{{ HTML::style('spcvn/font-awesome/4.5.0/css/font-awesome.min.css') }}
{{ HTML::style('spcvn/css/fonts.googleapis.com.css') }}
{{ HTML::style('spcvn/css/ace-skins.min.css') }}
{{ HTML::style('spcvn/css/ace-rtl.min.css') }}
<link rel="stylesheet" href="{{ asset('spcvn/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

{{ HTML::script('spcvn/js/ace-extra.min.js') }}
{{ HTML::script('spcvn/js/jquery-2.1.4.min.js') }}
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='spcvn/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
{{ HTML::script('spcvn/js/bootstrap.min.js') }}