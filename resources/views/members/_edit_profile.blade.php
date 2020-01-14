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
                        id="example-email">
                    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label class="col-md-12">@lang('validation.attributes.address')</label>
                <div class="col-md-12">
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
                <label class="col-md-12">@lang('validation.attributes.phone')</label>
                <div class="col-md-12">
                    <input type="text" name="phone" value="{{$member->phone}}"
                        class="form-control form-control-line">
                    {!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>

        </div>
    </div>
</div>

@foreach($field_groups as $group)
    <div class="section">
        <div class="card card-outline-info m-b-0">
            <div class="card-header bg-theme" data-toggle="collapse" data-target="#group-{{$group->id}}">
                <h4 class="m-b-0 text-white">{{$group->label_locale}}</h4>
            </div>
            <div class="card-body form-material row collapse show" id="group-{{$group->id}}"> 
                <div class="form-group col-md-6 m-t-20">
                    <label>
                        @lang('validation.attributes.name')                    
                        <span class="text-danger">*</span>
                    </label>           
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                </div>           
            </div>
        </div>
    </div>
@endforeach

<div class="card-footer text-center">
    <button type="submit" class="btn btn-success">@lang('layouts.buttons.update')</button>
        <!-- <a href="http://localhost:8000/field_groups" class="btn btn-secondary">Cancel</a> -->
</div>