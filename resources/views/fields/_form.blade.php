<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $field->id) !!}

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('name', $field->name, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.locale_key')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('locale_key', $field->locale_key, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('locale_key', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.field_group')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::select('field_group', $array_field_groups, $field->field_group_id, ['class' => 'form-control', 'placeholder' => config('constants.PLACEHOLDER_TYPE')['choose'] ]) !!}
                {!! $errors->first('field_group', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.field_type')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::select('field_type', $array_field_types, $field->field_type, ['class' => 'form-control', 'onchange' => 'onChangeFieldType(this)']) !!}
                {!! $errors->first('field_type', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20 default_value">
                <label>
                    @lang('validation.attributes.default_value')
                    {{-- <span class="text-danger">*</span> --}}
                </label>
                <div class="default_value_input">
                    {!! Form::text('default_value', $field->default_value, ['class' => 'form-control']) !!}
                </div>
                {!! $errors->first('default_value', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20 items_value" style="display:none">
                <label>
                    @lang('validation.attributes.items')
                    @lang('fields.hint_text.hint_text_items')
                    {{-- <span class="text-danger">*</span> --}}
                </label>
                <div class="items_value_input">
                    {!! Form::text('items', $field->items, ['class' => 'form-control']) !!}
                </div>
                {!! $errors->first('items', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20 max_length">
                <label>
                    @lang('validation.attributes.max_length')
                    {{-- <span class="text-danger">*</span> --}}
                </label>
                {!! Form::number('max_length', $field->max_length, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '1']) !!}
                {{-- {!! $errors->first('max_length', '<p class="text-danger">:message</p>') !!} --}}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.sequence')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::number('sequence', $field->sequence, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '0']) !!}
                {!! $errors->first('sequence', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>

        <div class="form-material row">

            <div class="col-md-6 m-t-20">
            {!! Form::checkbox('mandatory', null, (($field->mandatory) ? true : false), ['class' => 'check', 'id' => 'mandatory']) !!}
            <!-- <input type="checkbox" class="check" name="mandatory" id="mandatory" {{($field->mandatory) ? "checked='checked'" : "" }}> -->
                <label for="mandatory">
                    @lang('validation.attributes.mandatory')
                </label>
            </div>

            <div class="col-md-6 m-t-20">
            {!! Form::checkbox('show_in_report', null, (($field->show_in_report) ? true : false), ['class' => 'check', 'id' => 'show_in_report']) !!}
            <!-- <input type="checkbox" class="check" name="show_in_report" id="show_in_report" {{isset($field->id) ? (($field->show_in_report) ? "checked='checked'" : "") : "checked='checked'" }}> -->
                <label for="show_in_report">
                    @lang('validation.attributes.show_in_report')
                </label>
            </div>

            <div class="col-md-6 m-t-20">
            {!! Form::checkbox('show_in_portal', null, (($field->show_in_portal) ? true : false), ['class' => 'check', 'id' => 'show_in_portal']) !!}
            <!-- <input type="checkbox" class="check" name="show_in_portal" id="show_in_portal" {{isset($field->id) ? (($field->show_in_portal) ? "checked='checked'" : "") : "checked='checked'" }}> -->
                <label for="show_in_portal">
                    @lang('validation.attributes.show_in_portal')
                </label>
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($field->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('fields.index') }}" class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>

@section('extra_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            let field_type = $('.card-body select[name="field_type"]').val();
            $('.max_length').hide();
            $('.items_value').hide();
            if (field_type == {{ config('constants.FIELD_TYPE')['string'] }}
                || field_type == {{ config('constants.FIELD_TYPE')['single_choice'] }}
                || field_type == {{ config('constants.FIELD_TYPE')['multi_choice'] }}
                || field_type == {{ config('constants.FIELD_TYPE')['data_source'] }}) {
                if (field_type == {{ config('constants.FIELD_TYPE')['string'] }} ) {
                    $('.max_length').show();
                } else if (field_type == {{ config('constants.FIELD_TYPE')['single_choice'] }}
                    || field_type == {{ config('constants.FIELD_TYPE')['multi_choice'] }}) {
                    $('.items_value').show();
                }
            }
        });

        $('input[name="locale_key"]').on('input', function (e) {
            $(this).val($(this).val().replace(/[^A-Za-z0-9_]/g, ''));
        });

        function onChangeFieldType(item) {
            $(".default_value_input").html('');
            $('.max_length').hide();
            $('.items_value').hide();

            if ($(item).val() == {{ config('constants.FIELD_TYPE')['string'] }}
                || $(item).val() == {{ config('constants.FIELD_TYPE')['single_choice'] }}
                || $(item).val() == {{ config('constants.FIELD_TYPE')['multi_choice'] }}
                || $(item).val() == {{ config('constants.FIELD_TYPE')['data_source'] }}) {
                if ($(item).val() == {{ config('constants.FIELD_TYPE')['string'] }} ) {
                    $('.max_length').show();
                } else if ($(item).val() == {{ config('constants.FIELD_TYPE')['single_choice'] }}
                    || $(item).val() == {{ config('constants.FIELD_TYPE')['multi_choice'] }}) {
                    $('.items_value').show();
                }
                $(".default_value_input").html('<input class="form-control" name="default_value" type="text">');
            } else if ($(item).val() == {{ config('constants.FIELD_TYPE')['number'] }} ) {
                $(".default_value_input").html('<input class="form-control" name="default_value" type="text" onkeypress="return isNumber(event)"">');
            } else if ($(item).val() == {{ config('constants.FIELD_TYPE')['boolean'] }} ) {
                $(".default_value_input").html('<select class="form-control" name="default_value" ><option value="True">True</option><option value="False">False</option></select>');
            } else if ($(item).val() == {{ config('constants.FIELD_TYPE')['date'] }}) {
                $(".default_value_input").html('<input class="form-control" name="default_value" type="date">');
            }
        }
    </script>
@endsection
