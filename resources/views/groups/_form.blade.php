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
                  <!-- @foreach(config('constants.SYSTEM_PERMISSIONS') as $permission => $value)
                        <div class="col-md-6">
                            <input type="checkbox" class="check"
                                   {{ !empty($group->permissions) && in_array($permission, $group->permissions) ? 'checked' : '' }}
                                   {{ $group->builtin ? 'disabled' : '' }}
                                   name="permissions[]" id="permission_{{ $permission }}"
                                   value="{{ $permission }}">
                            <label for="permission_{{ $permission }}">
                                @lang('groups.system_permissions.' . $permission)
                            </label>

                            @for ($i = 0; $i < 4; $i++)
                                {{ $i }}
                            @endfor
                        </div>
                    @endforeach -->
                </div>

                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 40%">
                                    <label for="feature">
                                        Feature
                                    </label>
                                </th>
                                <th style="width: 15%">
                                    <label for="view_sys_permission_all">
                                        View
                                    </label>
                                </th>
                                <th style="width: 15%">
                                    <label for="create_sys_permission_all">
                                        Create
                                    </label>
                                </th>
                                <th style="width: 15%">
                                    <label for="edit_sys_permission_all">
                                        Edit
                                    </label>
                                </th>
                                <th style="width: 15%">
                                    <label for="delete_sys_permission_all">
                                        Delete
                                    </label>
                                </th>
                            </tr>
                        </thead>
                        <body>
                            @foreach(config('constants.SYSTEM_PERMISSIONS') as $permission => $value)
                            <tr>
                                <td>
                                    @lang('groups.system_permissions.' . $permission)
                                </td>
                                @for ($i = 1; $i <= 4; $i++)
                                    <td>
                                        @switch($i)
                                            @case (1)
                                            <input type="checkbox" class="check"
                                                   name="view_sys_permission_{{ $permission }}"
                                                   id="view_sys_permission_{{ $permission }}">
                                            <label for="view_sys_permission_{{ $permission }}"></label>
                                            @break
                                            @case (2)
                                            <input type="checkbox" class="check"
                                                   name="create_sys_permission_{{ $permission }}"
                                                   id="create_sys_permission_{{ $permission }}">
                                            <label for="create_sys_permission_{{ $permission }}"></label>
                                            @break
                                            @case (3)
                                            <input type="checkbox" class="check"
                                                   name="edit_sys_permission_{{ $permission }}"
                                                   id="edit_sys_permission_{{ $permission }}">
                                            <label for="edit_sys_permission_{{ $permission }}"></label>
                                            @break
                                            @case (4)
                                            <input type="checkbox" class="check"
                                                   name="delete_sys_permission_{{ $permission }}"
                                                   id="delete_sys_permission_{{ $permission }}">
                                            <label for="delete_sys_permission_{{ $permission }}"></label>
                                            @break
                                        @endswitch
                                    </td>
                                @endfor
                            </tr>
                            @endforeach
                        </body>
                    </table>
                </div>

                <h4 class="card-title m-t-20">@lang('groups.permission_groups.organization')</h4>
                <div clas="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 40%">
                                <label for="feature">
                                    Feature
                                </label>
                            </th>
                            <th style="width: 15%">
                                <label for="view_org_permission_all">
                                    View
                                </label>
                            </th>
                            <th style="width: 15%">
                                <label for="create_org_permission_all">
                                    Create
                                </label>
                            </th>
                            <th style="width: 15%">
                                <label for="edit_org_permission_all">
                                    Edit
                                </label>
                            </th>
                            <th style="width: 15%">
                                <label for="delete_org_permission_all">
                                    Delete
                                </label>
                            </th>
                        </tr>
                        </thead>
                        <body>
                            @foreach(config('constants.ORG_PERMISSIONS') as $permission => $value)
                                <tr>
                                    <td>
                                        @lang('groups.org_permissions.' . $permission)
                                    </td>

                                    @for ($i = 1; $i <= 4; $i++)
                                        <td>
                                            @switch($i)
                                                @case (1)
                                                <input type="checkbox" class="check"
                                                       name="view_org_permission_{{ $permission }}"
                                                       id="view_org_permission_{{ $permission }}">
                                                <label for="view_org_permission_{{ $permission }}"></label>
                                                @break
                                                @case (2)
                                                <input type="checkbox" class="check"
                                                       name="create_org_permission_{{ $permission }}"
                                                       id="create_org_permission_{{ $permission }}">
                                                <label for="create_org_permission_{{ $permission }}"></label>
                                                @break
                                                @case (3)
                                                <input type="checkbox" class="check"
                                                       name="edit_org_permission_{{ $permission }}"
                                                       id="edit_org_permission_{{ $permission }}">
                                                <label for="edit_org_permission_{{ $permission }}"></label>
                                                @break
                                                @case (4)
                                                <input type="checkbox" class="check"
                                                       name="delete_org_permission_{{ $permission }}"
                                                       id="delete_org_permission_{{ $permission }}">
                                                <label for="delete_org_permission_{{ $permission }}"></label>
                                                @break
                                            @endswitch
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </body>
                    </table>
                </div>
               <!-- <div class="row">
                    @foreach(config('constants.ORG_PERMISSIONS') as $permission => $value)
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
                </div> -->

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

@section('extra_scripts')
    <script type="text/javascript">
        $('#view_sys_permission_all').click(function () {
           if($(this).is(':checked'))
               $('input[id^="view_sys_permission__"]').attr('checked', true);
           else
               $('input[id^="view_sys_permission__"]').attr('checked', false);
        });
    </script>
@endsection
