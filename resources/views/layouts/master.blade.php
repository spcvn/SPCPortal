<!doctype html>
<html lang="en">

<head>
    @include('element.head')
    @yield('styles')
</head>

<body class="no-skin">
    @include('element.header')

    {{-- @include('partials.sidebar')

    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div> --}}

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>

        @include('element.sidebar')
        
        <div class="main-content">
            <div class="main-content-inner">

                @include('element.breadcrumbs')

                <div class="page-content">
                    @include('element.setting')

                    @yield('content')

                </div>
            </div>
        </div>

        @include('element.footer')
    </div>

    {{-- ace style --}}
    {{ HTML::script('spcvn/js/jquery-ui.custom.min.js') }}
    {{ HTML::script('spcvn/js/jquery.ui.touch-punch.min.js') }}
    {{ HTML::script('spcvn/js/jquery.easypiechart.min.js') }}
    {{ HTML::script('spcvn/js/jquery.sparkline.index.min.js') }}
    {{ HTML::script('spcvn/js/jquery.flot.min.js') }}
    {{ HTML::script('spcvn/js/jquery.flot.pie.min.js') }}
    {{ HTML::script('spcvn/js/jquery.flot.resize.min.js') }}
    {{ HTML::script('spcvn/js/ace-elements.min.js') }}
    {{ HTML::script('spcvn/js/ace.min.js') }}
    @yield('scripts')
</body>
</html>
