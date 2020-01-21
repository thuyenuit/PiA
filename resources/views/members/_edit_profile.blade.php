<div class="section p-t-20">
    <div class="card card-outline-info m-b-0">
        <div class="card-header bg-theme" data-toggle="collapse" data-target="#basic-group">
            <h4 class="m-b-0 text-white">Basic</h4>
        </div>

        <div class="card-body form-material row collapse show" id="basic-group">
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control">
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label class="col-md-12">
                    @lang('validation.attributes.email')
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-12">
                    <input type="email" name="email" value="{{$user->email}}"
                           class="form-control form-control-line" name="example-email"
                           id="example-email" readonly="readonly">
                    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.address')</label>
                <div>
                    <input type="text" name="address" value="{{$member->address}}"
                           class="form-control form-control-line">
                    {!! $errors->first('address', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label class="col-md-12">@lang('validation.attributes.town')</label>
                <div class="col-md-12">
                    <input type="text" name="town" value="{{$member->town}}"
                           class="form-control form-control-line">
                    {!! $errors->first('town', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.phone')</label>
                <div>
                    <input type="number" name="phone" value="{{$member->phone}}"
                           class="form-control form-control-line">
                    {!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.mobile_phone')</label>
                <div>
                    <input type="number" name="mobile_phone" value="{{$member->mobile_phone}}"
                           class="form-control form-control-line">
                    {!! $errors->first('mobile_phone', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <div>
                    <input type="checkbox" name="status" class="check"
                           id="status" {{($member->status) ? "checked='checked'" : "" }}>
                    <label for="status">@lang('validation.attributes.status')</label>
                    {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.birthday')</label>
                <div>
                    <input type="date" name="birthday" value="{{$member->birthday}}"
                           class="form-control form-control-line">
                    {!! $errors->first('birthday', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <div>
                    <label>@lang('validation.attributes.zip_code')</label>
                    <input type="number" name="zip_code" value="{{$member->zip_code}}"
                           class="form-control form-control-line">
                    {!! $errors->first('zip_code', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.pilot_id')</label>
                <div>
                    <input type="number" name="pilot_id" value="{{$member->pilot_id}}"
                           class="form-control form-control-line">
                    {!! $errors->first('pilot_id', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <div>
                    <label>@lang('validation.attributes.fai_no')</label>
                    <input type="text" name="fai_no" value="{{$member->fai_no}}"
                           class="form-control form-control-line">
                    {!! $errors->first('fai_no', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.fai_year')</label>
                <div>
                    <input type="text" name="fai_year" value="{{$member->fai_year}}"
                           class="form-control form-control-line">
                    {!! $errors->first('fai_year', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>@lang('validation.attributes.d_no')</label>
                <div>
                    <input type="text" name="d_no" value="{{$member->d_no}}"
                           class="form-control form-control-line">
                    {!! $errors->first('d_no', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

        </div>
    </div>
</div>

@foreach($field_groups as $group)
    <div class="section">
        <div class="card card-outline-info m-b-0">
            <div class="card-header bg-theme" data-toggle="collapse" data-target="#group-{{$group->id}}">
                <h4 class="m-b-0 text-white">{{ $group->name }}</h4>
            </div>
            <div class="card-body form-material row collapse show" id="group-{{$group->id}}">
                @foreach($fields as $field)
                    @if($field->field_group_id == $group->id)
                        <div class="form-group col-md-6 m-t-20">

                            @switch ($field->field_type)
                                @case (config('constants.FIELD_TYPE')['string'])
                                @case (config('constants.FIELD_TYPE')['number'])
                                <label>
                                    {{ $field->field_name }}
                                    @if($field->mandatory == true)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>

                                <input
                                    type="{{ ($field->field_type == config('constants.FIELD_TYPE')['string']) ? 'text' : 'number' }}"
                                    name="{{ $field->field_locale_key }}"
                                    value="{{ $field->value }}" class="form-control"
                                    maxlength="{{ isset($field->setting->max_length) ? $field->setting->max_length : '' }}">
                                @break
                                @case (config('constants.FIELD_TYPE')['boolean'])

                                @break
                                @case (config('constants.FIELD_TYPE')['date'])

                                @break
                                @case (config('constants.FIELD_TYPE')['single_choice'])
                                <label>
                                        {{ $field->field_name }}
                                        @if($field->mandatory == true)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    
                                    <div class="input-group field-multi">

                                    
                                        <select name="{{$field->field_locale_key}}" class="form-control"> 
                                            <option value="">{{config('constants.PLACEHOLDER_TYPE')['choose']}}</option>                                     
                                            @foreach($field->items as $item => $value)
                                                @if(!is_null($field->value))                                       
                                                    @if($field->value == $value)                        
                                                        <option selected="selected" value="{{$value}}">{{$value}}</option>                                                 
                                                    @else                         
                                                        <option value="{{$value}}">{{$value}}</option>
                                                    @endif                                              
                                                @else                                              
                                                    @if($field->default == $value)                                                   
                                                        <option selected="selected" value="{{$value}}">{{$value}}</option>
                                                    @else
                                                        <option value="{{$value}}">{{$value}}</option>
                                                    @endif
                                                @endif                                               
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                @break
                                @case (config('constants.FIELD_TYPE')['multi_choice'])
                                    <label>
                                        {{ $field->field_name }}
                                        @if($field->mandatory == true)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    
                                    <div class="input-group field-multi">
                                        {!! Form::select($field->field_locale_key . '[]', $field->items, null, [
                                            'class' => 'form-control select2-multiple', 
                                            'multiple' => 'multiple'
                                        ]) !!}
                                    </div>
                                @break
                                @case (config('constants.FIELD_TYPE')['data_source'])

                                @break
                            @endswitch

                            @if($field->mandatory == true)
                                {!! $errors->first($field->field_locale_key, '<p class="text-danger">:message</p>') !!}
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endforeach

<div class="card-footer text-center">
    <button type="submit" class="btn btn-success">@lang('layouts.buttons.update')</button>
    <!-- <a href="http://localhost:8000/field_groups" class="btn btn-secondary">Cancel</a> -->
</div>

@section('extra_scripts')
    <script>
        $('.dropify').dropify(dropifyOptions());
        $('.select2-multiple').select2({
            //placeholder: ""
        });
        $('.select2-single').select2();
    </script>
@endsection


