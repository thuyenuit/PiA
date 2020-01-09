@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')
    <div class="page-content">
        {!! Form::open(['method' => 'POST', 'url' => ['/settings/app'], 'files' => true]) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($configurations as $configuration)
                        <div class="col-md-6 form-group">
                            <label for="{{$configuration->config_key}}">
                                @lang('validation.attributes.' . $configuration->config_key)
                            </label>
                            <input type="hidden" name="delete_{{$configuration->config_key}}"
                                   id="delete_{{$configuration->config_key}}" value="false">
                            <input type="file" name="{{$configuration->config_key}}" class="dropify"
                                   @if($configuration->config_key == config('constants.CONFIG_KEY.SITE_FAVICON'))
                                   data-allowed-formats="square"
                                   @endif
                                   @if(!empty($configuration->config_value))
                                   data-default-file="{{ $configuration->imageUrl() }}"
                                   @endif
                                   data-max-file-size="500K"
                                   data-allowed-file-extensions="jpg jpeg png gif svg"/>
                            {!! $errors->first($configuration->config_key, '<div class="text-danger">:message</div>') !!}
                        </div>
                    @endforeach
                </div>
                <div class="form-material row">
                    @foreach($app_languages as $app_language)
                        <div class="form-group col-md-6 m-t-20">
                            <label for="app_name_{{ $app_language->lang_key }}">
                                @lang('settings.index.app_name', ['language' => $app_language->label])
                            </label>
                            <input type="text" class="form-control" maxlength="191"
                                   id="app_name_{{ $app_language->lang_key }}"
                                   name="app_name[{{ $app_language->lang_key }}]"
                                   placeholder="{{ CommonHelper::getTranslation('app', 'name', 'en') }}"
                                   value="{{ CommonHelper::getTranslation('app', 'name', $app_language->lang_key) }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        {!! Form::submit(trans('layouts.buttons.update'), ['class' => 'btn btn-outline-success']) !!}
                        <a href="{{route('home')}}" class="btn btn-outline-secondary">
                            @lang('layouts.buttons.cancel')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('extra_scripts')
    <script>
        let drEvent = $('.dropify').dropify(dropifyOptions());

        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm('@lang('settings.index.delete_image')');
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            $('#delete_' + element.element.name).val("true");
        });
    </script>
@endsection
