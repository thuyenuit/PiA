@extends('layouts.empty')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="form-horizontal form-material" id="loginform">
        @csrf

        <h3 class="box-title m-b-20">@lang('auth.passwords.email.title')</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group ">
            <div class="col-xs-12">
                <input type="email" required autocomplete="email" autofocus
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="@lang('validation.attributes.email')">

                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                    @lang('auth.passwords.email.button_text')
                </button>
            </div>
        </div>
    </form>
@endsection
