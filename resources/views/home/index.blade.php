@extends('layouts.app')

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">@lang('layouts.sidebar.dashboard')</h3>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h2>@lang('home.index.welcome_text', ['app_name' => __('app.name')])</h2>
            </div>
        </div>
    </div>
@endsection
