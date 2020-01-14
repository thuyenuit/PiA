<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $field_group->id) !!}
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('label_locale', $field_group->label_locale, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('label_locale', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.sequence')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::number('sequence', $field_group->sequence, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '0']) !!}
                {!! $errors->first('sequence', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($field_group->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('field_groups.index') }}"
           class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>
