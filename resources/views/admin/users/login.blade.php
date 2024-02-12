@extends('.admin.layouts.user')

@section('title', 'Login')

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" title="E-mail">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3 password">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" title="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <a href="#" title="Show password">
                        <span class="fas fa-lock"></span>
                    </a>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3 password" style="display: none">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation" title="Password confirmation">
            <div class="input-group-append">
                <div class="input-group-text">
                    <a href="#" title="Show password">
                        <span class="fas fa-lock"></span>
                    </a>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3" style="display: none">
            <input type="text" class="form-control" id="question" name="question" title="Security question" readonly>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-question"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3" style="display: none">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer to the security question above" title="Security answer">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-check"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <input type="hidden" id="scenario" name="scenario" value="0">
        <div class="row">
            <div class="col-4 offset-8">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </form>
    <div class="mt-2"><a href="{{ route('register.create') }}" title="Register">Not registered yet?</a></div>
    <div class="mt-2"><a href="#" id="forgot-password">Forgot password?</a></div>
    <div class="mt-2"><a href="{{ route('home') }}">Home page</a></div>
@endsection

@section('scripts')
    <script>
        $('#forgot-password').click(function (e) {
            e.preventDefault();
            if ($(this).text() === 'Forgot password?') {
                $('#scenario').val(1);
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').empty();
                $('.alert').remove();
                $('#password').val('').parent().hide();
                $(this).text('Remember password?');
            } else if ($(this).text() === 'Remember password?') {
                $('#scenario').val(0);
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').empty();
                $('.alert').remove();
                $('#password').attr('title', 'Password').attr('placeholder', 'Password').val('').parent().show();
                $('#password_confirmation').val('').parent().hide();
                $('#question').val('').parent().hide();
                $('#answer').val('').parent().hide();
                $(this).text('Forgot password?');
            }
        });
    </script>
@endsection
