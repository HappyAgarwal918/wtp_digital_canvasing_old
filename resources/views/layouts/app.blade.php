<!doctype html>
<html id="html" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <link type="text/css" href="{{ asset('css/admin.css') }}" rel="stylesheet" media="screen">
</head>

<body>
    <section id="messages">
        <div id="alert" class="alert d-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block system-message m-0 p-0 clearfix">
                            <span id="system-message"></span>
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session('success') || session('warning') || session('error'))
        <div id="alert-session" class="alert @if(session('success')) alert-success @elseif(session('warning')) alert-warning @elseif(session('error')) alert-danger @endif alert-dismissible fade show">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block system-message m-0 p-0 clearfix">
                            <strong>
                                @if(session('success')) Success! @elseif(session('warning')) Warning! @elseif(session('error')) Error!
                                @endif
                            </strong>
                            @if(session('success'))
                            {!! session('success') !!}
                            @elseif(session('warning'))
                            {!! session('warning') !!}
                            @elseif(session('error'))
                            {!! session('error') !!}
                            @endif
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
    @yield('content')
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>

</html>
