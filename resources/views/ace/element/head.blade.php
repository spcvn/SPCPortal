<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('page-title') | {{ settings('app_name') }}</title>

<meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

{{ HTML::style('spcvn/ace/css/ace-rtl.min.css') }}
{{ HTML::style('spcvn/ace/css/select2.min.css') }}
{{ HTML::style('spcvn/ace/css/style.custom.css') }}
{{ HTML::style('spcvn/ace/css/bootstrap.min.css') }}
{{ HTML::style('spcvn/ace/css/ace-skins.min.css') }}
{{ HTML::style('spcvn/ace/css/fonts.googleapis.com.css') }}
{{ HTML::style('spcvn/ace/css/bootstrap-duallistbox.min.css') }}
{{ HTML::style('spcvn/ace/css/bootstrap-multiselect.min.css') }}
{{ HTML::style('spcvn/ace/css/ace.min.css', array('class' => 'ace-main-stylesheet', 'id' => 'main-ace-style')) }}
{{ HTML::style('spcvn/ace/font-awesome/4.5.0/css/font-awesome.min.css') }}

{{ HTML::script('spcvn/ace/js/ace-extra.min.js') }}
{{ HTML::script('spcvn/ace/js/jquery-2.1.4.min.js') }}
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='spcvn/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
{{ HTML::script('spcvn/ace/js/bootstrap.min.js') }}