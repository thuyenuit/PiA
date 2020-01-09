<div class="card">
    <div class="card-body">
        <div class="form-material row">
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.lang_key')
                    @lang('translations.hints.lang_key')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('lang_key', $language->lang_key, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('lang_key', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.flag')
                    @lang('translations.hints.flag')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('flag', $language->flag, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('flag', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.label')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('label', $language->label, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('label', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($language->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('translations.index') }}"
           class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>
