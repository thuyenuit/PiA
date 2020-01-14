<div class="card">
    <div class="card-body">
        <div class="m-t-30 text-center">
            <img id="root_avatar"
                 src="{{ $member->avatarUrl() }}"
                 class="img-circle" width="150" alt=""/>
            <br>
            <a href="javascript:void(0)" id="edit_avatar" class="edit-avatar m-t-20">
                <i class="fa fa-edit"></i>
                @lang('layouts.buttons.edit')
            </a>
            <h4 class="card-title m-t-10">{{ $user->name }}</h4>
        </div>
    </div>

    <div>
        <hr>
    </div>

    <div class="card-body">
        <small class="text-muted">@lang('validation.attributes.email')</small>
        <h6>{{ $user->email }}</h6>

        @if(!empty($member->phone))
            <small class="text-muted p-t-30 db">@lang('validation.attributes.phone')</small>
            <h6>{{ $member->phone }}</h6>
        @endif

        @if(!empty($member->address))
            <small class="text-muted p-t-30 db">@lang('validation.attributes.address')</small>
            <h6>{{ $member->address }}</h6>

            <div class="map-box">
                <iframe id="gmap_canvas" width="100%" height="150" style="border:0" allowfullscreen
                        src="https://maps.google.com/maps?q={{ urldecode($user->address) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
            </div>
        @endif
    </div>
</div>
