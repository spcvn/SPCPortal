<!doctype html>
<html lang="en">

<head>
    @include('ace.element.head')
    @yield('styles')
</head>

<body class="no-skin">
    @include('ace.element.header')

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>

        @include('ace.element.sidebar')
        
        <div class="main-content">
            <div class="main-content-inner">

                @include('ace.element.breadcrumbs')

                <div class="page-content">
                    @include('ace.element.setting')
                    @yield('content')
                </div>
            </div>
        </div>

        @include('ace.element.footer')
    </div>

    {{-- ace style --}}
    {{ HTML::script('spcvn/ace/js/jquery-ui.custom.min.js') }}
    {{ HTML::script('spcvn/ace/js/jquery.ui.touch-punch.min.js') }}
    {{ HTML::script('spcvn/ace/js/jquery.easypiechart.min.js') }}
    {{ HTML::script('spcvn/ace/js/jquery.sparkline.index.min.js') }}
    {{ HTML::script('spcvn/ace/js/jquery.flot.min.js') }}
    {{ HTML::script('spcvn/ace/js/jquery.flot.pie.min.js') }}
    {{ HTML::script('spcvn/ace/js/jquery.flot.resize.min.js') }}
    {{ HTML::script('spcvn/ace/js/ace-elements.min.js') }}
    {{ HTML::script('spcvn/ace/js/ace.min.js') }}
    @yield('scripts')
</body>
</html>
