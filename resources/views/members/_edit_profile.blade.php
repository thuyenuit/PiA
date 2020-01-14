<div id="setting">
    <div class="card">
        <ul class="nav nav-tabs profile-tab list-unstyled" role="tabpanel">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Settings</a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="settings" role="tabpanel">

                <div class="card-body">

                    <form class="form-horizontal form-material" method="post"
                          action="{{ route('my_profile') }}">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <label class="col-md-12">@lang('validation.attributes.name')</label>

                            <div class="col-md-12">

                                <input type="text" name="name" value="{{$user->name}}"
                                       class="form-control form-control-line">
                                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-12">@lang('validation.attributes.email')</label>

                            <div class="col-md-12">

                                <input type="email" name="email" value="{{$user->email}}"
                                       class="form-control form-control-line" name="example-email"
                                       id="example-email">
                                {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-12">@lang('validation.attributes.address')</label>

                            <div class="col-md-12">

                                <input type="text" name="address" value="{{$member->address}}"
                                       class="form-control form-control-line">
                                {!! $errors->first('address', '<p class="text-danger">:message</p>') !!}
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-12">@lang('validation.attributes.town')</label>

                            <div class="col-md-12">

                                <input type="text" name="town" value="{{$member->town}}"
                                       class="form-control form-control-line">
                                {!! $errors->first('town', '<p class="text-danger">:message</p>') !!}
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-12">@lang('validation.attributes.phone')</label>

                            <div class="col-md-12">

                                <input type="text" name="phone" value="{{$member->phone}}"
                                       class="form-control form-control-line">
                                {!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="col-sm-12">

                                <button type="submit"
                                        class="btn btn-success">@lang('layouts.buttons.update')</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
