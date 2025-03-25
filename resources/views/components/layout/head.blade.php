<head>
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}} - {{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{env('APP_DESC')}}" name="description" />
    <meta content="{{env('APP_ORG')}}" name="{{env('APP_AUTHOR')}}" />
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/toastr/build/toastr.min.css')}}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/mine/mystyle.css') }}" rel="stylesheet" type="text/css" />
</head>