<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'passwords' => [
        'email' => [
            'title' => 'Reset Password',
            'button_text' => 'Send Password Reset Link',
        ],
        'reset' => [
            'title' => 'Reset Password',
            'button_text' => 'Reset Password',
        ],
    ],
    'login' => [
        'title' => 'Sign In',
        'remember_me' => 'Remember me',
        'forgot_password_link' => 'Forgot pwd?',
        'button_text' => 'Sign In',
        'question' => 'Don\'t have an account?',
        'sign_up_link' => 'Sign Up',
    ],
    'register' => [
        'title' => 'Sign Up',
        'button_text' => 'Sign Up',
        'question' => 'Already have an account?',
        'sign_in_link' => 'Sign In',
    ],

];
