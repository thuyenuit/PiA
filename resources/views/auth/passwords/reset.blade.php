@extends('layouts.empty')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="form-horizontal form-material" id="loginform">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <h3 class="box-title m-b-20">@lang('auth.passwords.reset.title')</h3>

        <div class="form-group ">
            <div class="col-xs-12">
                <input type="email" required autocomplete="email" autofocus
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ $email ?? old('email') }}"
                       placeholder="@lang('validation.attributes.email')">

                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input type="password" required autocomplete="new-password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="@lang('validation.attributes.password')">

                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input type="password" required autocomplete="new-password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password_confirmation"
                       placeholder="@lang('validation.attributes.password_confirmation')">

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                    @lang('auth.passwords.reset.button_text')
                </button>
            </div>
        </div>
    </form>
@endsection
