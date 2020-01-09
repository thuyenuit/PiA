@extends('emails.app')

@section('content')
    <h1 style="color: #3d4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
        @lang('email.auth.reset.greeting', ['user_name' => $params['name']])
    </h1>
    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        @lang('email.auth.reset.welcome_text')
    </p>
    <table class="action" style="margin: 30px auto; padding: 0; text-align: center; width: 100%;">
        <tbody>
        <tr>
            <td>
                <a class="button button-primary" href="{{ $params['reset_password_url'] }}" target="_blank"
                   style="border-radius: 3px; box-shadow: 0 2px 3px ; color: #fff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3490dc; border-top: 10px solid #3490dc; border-right: 18px solid #3490dc; border-bottom: 10px solid #3490dc; border-left: 18px solid #3490dc;">
                    @lang('email.auth.reset.button_text')
                </a>
            </td>
        </tr>
        </tbody>
    </table>
    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        @lang('email.auth.reset.expire_text')
    </p>
    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        @lang('email.auth.reset.skip_text')
    </p>
    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        @lang('email.auth.reset.signature')
        <br>
        @lang('app.name')
    </p>

    <table class="subcopy" style="border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
        <tbody>
        <tr>
            <td>
                <p style="color: #3d4852; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">
                    @lang('email.auth.reset.plain_link_text')
                    <br>
                    <a href="{{ $params['reset_password_url'] }}" style="color: #3869d4;" target="_blank">
                        {{ $params['reset_password_url'] }}
                    </a>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
