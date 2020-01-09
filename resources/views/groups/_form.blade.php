<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $group->id) !!}
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('name', $group->name, ['class' => 'form-control', 'maxlength' => '191', $group->builtin ? 'disabled' : '']) !!}
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-12 m-t-20">
                <label>
                    @lang('validation.attributes.description')
                </label>
                {!! Form::textarea('description', $group->description, ['class' => 'form-control', 'rows' => 5]) !!}
                {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-12 m-t-20">
                <h4 class="card-title">@lang('groups.permission_groups.system')</h4>
                <div class="row">
                    @foreach(config('constants.SYSTEM_PERMISSIONS') as $permission)
                        <div class="col-md-6">
                            <input type="checkbox" class="check"
                                   {{ !empty($group->permissions) && in_array($permission, $group->permissions) ? 'checked' : '' }}
                                   {{ $group->builtin ? 'disabled' : '' }}
                                   name="permissions[]" id="permission_{{ $permission }}"
                                   value="{{ $permission }}">
                            <label for="permission_{{ $permission }}">
                                @lang('groups.system_permissions.' . $permission)
                            </label>
                        </div>
                    @endforeach
                </div>

                <h4 class="card-title m-t-20">@lang('groups.permission_groups.organization')</h4>
                <div class="row">
                    @foreach(config('constants.ORG_PERMISSIONS') as $permission)
                        <div class="col-md-6">
                            <input type="checkbox" class="check"
                                   {{ !empty($group->permissions) && in_array($permission, $group->permissions) ? 'checked' : '' }}
                                   {{ $group->builtin ? 'disabled' : '' }}
                                   name="permissions[]" id="permission_{{ $permission }}"
                                   value="{{ $permission }}">
                            <label for="permission_{{ $permission }}">
                                @lang('groups.org_permissions.' . $permission)
                            </label>
                        </div>
                    @endforeach
                </div>
                {!! $errors->first('permissions', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($group->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('groups.index') }}"
           class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>
