@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('groups.users.store', $group)]) !!}
        <div class="card">
            <div class="card-body">
                <div class="form-material row">
                    {!! Form::hidden('group_id', $group->id) !!}
                    <div class="form-group col-md-6 m-t-20">
                        <label>
                            @lang('validation.attributes.user_id')
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::select('user_id', $users, $group_user->user_id, ['class' => 'form-control', 'maxlength' => '191']) !!}
                        {!! $errors->first('user_id', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group col-md-6 m-t-20">
                        <label>
                            @lang('validation.attributes.club_id')
                        </label>
                        {!! Form::text('club_id', $group_user->club_id, ['class' => 'form-control', 'maxlength' => '191']) !!}
                        {!! $errors->first('club_id', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                {!! Form::submit(__('layouts.buttons.create'), ['class' => 'btn btn-success']) !!}
                <a href="{{ route('groups.show', $group) }}"
                   class="btn btn-secondary">
                    @lang('layouts.buttons.cancel')
                </a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
