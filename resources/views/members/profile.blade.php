@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            @include('members._user_info')
        </div>

        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs profile-tab">
                        @foreach(config('constants.PROFILE_TABS') as $tab)
                            @php
                                $link = route('my_profile', ['tab' => $tab]);
                                $active = $currentTab == $tab ? 'active' : '';
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link {{ $active }}" href="{{ $link }}">
                                    @lang("members.tabs.$tab")
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            @if($currentTab == 'info')
                                {!! Form::model($user, ['method' => 'PATCH', 'url' => 'admin/my-profile']) !!}
                                @include ('admin.users._form')
                                {!! Form::close() !!}
                            @elseif($currentTab == $tabs['password'])
                                {!! Form::model($user, ['method' => 'PATCH', 'url' => 'admin/my-profile/password']) !!}
                                @include ('admin.users._form_password')
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{--            @include('members._edit_profile')--}}

            {{--            @include('members._edit_avatar')--}}
        </div>
    </div>
@endsection


