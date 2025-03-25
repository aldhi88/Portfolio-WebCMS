<body class="auth-body-bg">
    <div class="loading"><div class="loader"></div></div>
    <div>
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-4">
                    <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                        <div class="w-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div>
                                        <div class="text-center">
                                            <div>
                                                <a href="index.html" class="logo"><img src="{{asset('assets/images/favicon.png')}}" height="100" alt="logo"></a>
                                            </div>
                                            <h4 class="font-size-18 mt-4">{{$title}}</h4>
                                            <p class="text-muted">{{$desc}}</p>
                                            {{-- @if ($form == 'login')
                                                <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                                <p class="text-muted">Sign in to continue to {{env('APP_NAME')}}.</p>
                                            @else
                                                <h4 class="font-size-18 mt-4">Register account</h4>
                                                <p class="text-muted">Get your free {{env('APP_NAME')}} account now.</p>
                                            @endif --}}
                                            
                                        </div>
