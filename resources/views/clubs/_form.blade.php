<div class="card">
    <div class="card-body">
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group cf-field" data-name="club_logo">
                    <label>@lang('validation.attributes.club_logo')</label>
                    <div class="input-group">
                        <input type="file" name="club_logo" class="dropify"
                               data-max-file-size="500K"
                               data-show-remove="false"
                               data-default-file="{{$club->imageUrl()}}"
                               data-allowed-file-extensions="jpg jpeg png gif svg"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group cf-field" data-name="type_of_aircarft">
                    <label>@lang('validation.attributes.aircraft_type')</label>
                    <div class="input-group">
                        <div class="demo-checkbox">
                            @foreach($services as $key => $value)
                                <input type="checkbox" name="aircraft_type[]" value="{{$value}}"
                                       {{ !empty($club->aircraft_type) && in_array($value, $club->aircraft_type) ? 'checked' : '' }}
                                       class="filled-in form-control" id="{{$key}}">
                                <label for="{{$key}}">{{$value}}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Box field -->
        <div class="section m-b-20 cf-field" data-name="club_data">
            <div class="card card-outline-info m-b-0">
                <div class="card-header bg-theme">
                    <h4 class="m-b-0 text-white">@lang('validation.attributes.club_data')</h4>
                </div>
                <div class="card-body p-b-0">
                    <div class="form-row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="name">
                                <label>@lang('validation.attributes.name') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {!! Form::text('name', $club->name, ['class' => 'form-control']) !!}
                                </div>
                                {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="region">
                                <label>@lang('validation.attributes.region') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {!! Form::text('region', $club->region, ['class' => 'form-control']) !!}
                                </div>
                                {!! $errors->first('region', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="address">
                                <label>@lang('validation.attributes.address') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {!! Form::text('address', $club->address, ['class' => 'form-control']) !!}
                                </div>
                                {!! $errors->first('address', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="zip_code">
                                <label>@lang('validation.attributes.zip_code')</label>
                                <div class="input-group">
                                    {!! Form::text('zip_code', $club->zip_code, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="town">
                                <label>@lang('validation.attributes.town')</label>
                                <div class="input-group">
                                    {!! Form::text('town', $club->town, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="email">
                                <label>@lang('validation.attributes.email') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {!! Form::email('email', $club->email, ['class' => 'form-control']) !!}
                                </div>
                                {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group cf-field" data-name="internet">
                                <label>@lang('validation.attributes.internet')</label>
                                <div class="input-group">
                                    {!! Form::url('internet', $club->internet, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section m-b-20 cf-field" data-name="contact_persons">
            <div class="card card-outline-info m-b-0">
                <div class="card-header bg-theme">
                    <h4 class="m-b-0 text-white">@lang('validation.attributes.contact_persons')</h4>
                </div>
                <div class="card-body p-b-0">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group cf-field" data-name="club_admin">
                                <label>@lang('validation.attributes.club_admin_ids')</label>
                                <div class="input-group">
                                    {!! Form::select('club_admin_ids[]', $users, $club->club_admin_ids, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group cf-field" data-name="chef_instructor">
                                <label>@lang('validation.attributes.chef_instructor_id')</label>
                                <div class="input-group">
                                    <select class="form-control select2-single" name="chef_instructor_id">
                                        <option value="">@lang('clubs.placeholder.select2-single')</option>
                                        @foreach($users as $key => $value)
                                            <option value="{{$key}}" {{ $key == $club->chef_instructor_id ? 'selected' : '' }} >{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group cf-field" data-name="club_contact">
                                <label>@lang('validation.attributes.club_contact_ids')</label>
                                <div class="input-group">
                                    {!! Form::select('club_contact_ids[]', $users, $club->club_contact_ids, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section m-b-20 cf-field" data-name="club_payment">
            <div class="card card-outline-info m-b-0">
                <div class="card-header bg-theme">
                    <h4 class="m-b-0 text-white">@lang('validation.attributes.club_payment')</h4>
                </div>
                <div class="card-body p-b-0">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group cf-field" data-name="charge_club_of_quota">
                                <label>@lang('validation.attributes.charge_club_of_quota')</label>
                                <div class="input-group">
                                    <div class="switch">
                                        <label>@lang('validation.attributes.no') {!! Form::checkbox('charge_club_of_quota', null, isset($club) ? $club->charge_club_of_quota : false, ['class' => 'with-gap form-control', 'id' => 'charge_club_of_quota']) !!}
                                            <span class="lever"></span>@lang('validation.attributes.yes')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group cf-field" id="monthly_payment" data-name="monthly_payment" {!! $club->charge_club_of_quota == false ? 'style="display: none;"': '' !!}>
                                <label>@lang('validation.attributes.monthly_payment')</label>
                                <div class="input-group">
                                    <input type="text" name="monthly_payment" value="{!! $club->monthly_payment !!}" class="form-control">
                                </div>
                                {!! $errors->first('monthly_payment', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($club->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('clubs.index') }}"
           class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>

