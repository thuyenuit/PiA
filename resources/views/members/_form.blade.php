<div class="card">
    <div class="card-body">
        <div class="form-material row">
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger"> *</span>
                </label>
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.email')
                    <span class="text-danger"> *</span>
                </label>
                {!! Form::text('email', $user->email, ['class' => 'form-control', 'maxlength' => '191', 'disabled' => isset($user->id)]) !!}
                {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
            </div>
            @if(!isset($user->id))
                <div class="form-group col-md-6 m-t-20">
                    <label>
                        @lang('validation.attributes.password')
                        <span class="text-danger"> *</span>
                    </label>
                    {!! Form::password('password', ['class' => 'form-control', 'maxlength' => '191']) !!}
                    {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="form-group col-md-6 m-t-20">
                    <label>
                        @lang('validation.attributes.password_confirmation')
                        <span class="text-danger"> *</span>
                    </label>
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'maxlength' => '191']) !!}
                    {!! $errors->first('password_confirmation', '<p class="text-danger">:message</p>') !!}
                </div>
            @endif

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.main_club')</label>
                {!! Form::select('main_club', $array_clubs, $user->main_club_id, ['class' => 'form-control', 'placeholder' => config('constants.PLACEHOLDER_TYPE')['choose'] ]) !!}
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($user->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('members.index') }}"
           class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>
