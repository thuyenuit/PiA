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

        <div class="section">
            <div class="card card-outline-info m-b-0">
                <div class="card-header bg-theme" data-toggle="collapse" data-target="#club_data">
                    <h4 class="m-b-0 text-white">@lang('validation.attributes.club_data')</h4>
                </div>

                <div class="card-body form-material row collapse show" id="club_data">
                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.name')
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::text('name', $club->name, ['class' => 'form-control']) !!}
                        {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.email') <span class="text-danger">*</span></label>
                        {!! Form::email('email', $club->email, ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.region') <span class="text-danger">*</span></label>
                        {!! Form::text('region', $club->region, ['class' => 'form-control']) !!}
                        {!! $errors->first('region', '<div class="text-danger">:message</div>') !!}
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.address') <span class="text-danger">*</span></label>
                        {!! Form::text('address', $club->address, ['class' => 'form-control']) !!}
                        {!! $errors->first('address', '<div class="text-danger">:message</div>') !!}
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.zip_code')</label>
                        {!! Form::text('zip_code', $club->zip_code, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.town')</label>
                        {!! Form::text('town', $club->town, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.internet')</label>
                        {!! Form::url('internet', $club->internet, ['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
        </div>

        <div class="section">
            <div class="card card-outline-info m-b-0">
                <div class="card-header bg-theme" data-toggle="collapse" data-target="#contact_persons">
                    <h4 class="m-b-0 text-white">@lang('validation.attributes.contact_persons')</h4>
                </div>

                <div class="card-body form-material row collapse show" id="contact_persons">
                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.club_admin_ids')</label>
                        <div class="input-group field-multi">
                            {!! Form::select('club_admin_ids[]', $users, $club->club_admin_ids, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.chef_instructor_id')</label>
                        <div class="input-group ">
                            <select class="form-control select2-single" name="chef_instructor_id">
                                <option value="">@lang('clubs.placeholder.select2-single')</option>
                                @foreach($users as $key => $value)
                                    <option
                                        value="{{$key}}" {{ $key == $club->chef_instructor_id ? 'selected' : '' }} >{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.club_contact_ids')</label>
                        <div class="input-group field-multi">
                            {!! Form::select('club_contact_ids[]', $users, $club->club_contact_ids, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card card-outline-info m-b-0">
                <div class="card-header bg-theme" data-toggle="collapse" data-target="#club_payment">
                    <h4 class="m-b-0 text-white">@lang('validation.attributes.club_payment')</h4>
                </div>

                <div class="card-body form-material row collapse show" id="club_payment">
                    <div class="form-group col-md-6 m-t-20">
                        <label>@lang('validation.attributes.charge_club_of_quota')</label>
                        <div class="input-group">
                            <div class="switch">
                                <label>@lang('validation.attributes.no')
                                    {!! Form::checkbox('charge_club_of_quota', null, isset($club) ? $club->charge_club_of_quota : false, ['class' => 'with-gap form-control', 'id' => 'charge_club_of_quota']) !!}
                                    <span class="lever"></span>@lang('validation.attributes.yes')</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 m-t-20" id="monthly_payment" data-name="monthly_payment"  {!! $club->charge_club_of_quota == false ? 'style="display: none;"': '' !!}>
                        <label>@lang('validation.attributes.monthly_payment')</label>
                        <div class="input-group">
                            {!! Form::text('monthly_payment', $club->monthly_payment, ['class' => 'form-control']) !!}
                        </div>
                        {!! $errors->first('monthly_payment', '<div class="text-danger">:message</div>') !!}
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
