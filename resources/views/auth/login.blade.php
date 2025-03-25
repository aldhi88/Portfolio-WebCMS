<!doctype html>
<html lang="en">
@include('components.layout.head',['title'=>'Login Form'])
@section('js')
    @include('auth.include.login_js')
@endsection
@include('components.layout.auth_header', [
    'title' => 'Halaman Login',
    'desc' => 'Masuk untuk dapat mengelola website.'
])

<div class="p-2 mt-5">
    <form id="loginForm">@csrf

        <div class="form-group auth-form-group-custom mb-4">
            <i class="ri-user-2-line auti-custom-input-icon"></i>
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Ketik username anda">
            <span class="invalid-feedback username msg text-danger"></span>
        </div>

        <div class="form-group auth-form-group-custom mb-4">
            <i class="ri-lock-2-line auti-custom-input-icon"></i>
            <label for="userpassword">Password</label>
            <input name="password" type="password" class="form-control" id="userpassword" placeholder="Ketik password anda">
            <span class="invalid-feedback password msg text-danger"></span>
        </div>

        {{-- <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customControlInline">
            <label class="custom-control-label" for="customControlInline">Remember me</label>
        </div> --}}

        <div class="mt-4 text-center">
            <button class="btn btn-primary w-md waves-effect waves-light btn-block" type="submit">Masuk</button>
        </div>

        <div class="mt-4 text-center">
            <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Lupa Password?</a>
        </div>
    </form>
</div>

@include('components.layout.auth_footer', ['form' => 'login'])

@include('components.layout.script')
</body>
</html>
