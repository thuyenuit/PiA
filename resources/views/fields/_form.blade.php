<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $customfield->id) !!}

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('name', $customfield->name, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.label_locale')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('label_locale', $customfield->label_locale, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('label_locale', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.field_group')
                    <span class="text-danger">*</span>
                </label>
                <select name="field_group"  class="form-control">
                    <option value> @lang('validation.attributes.choose_select_tag')</option>
                    @foreach($arraycfgs as $arraycfg)
                        <option value="{{$arraycfg['key']}}">{{$arraycfg['value']}}</option>
                    @endforeach
                </select>
                {!! $errors->first('field_group', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.field_type')
                    <span class="text-danger">*</span>
                </label>
                <select name="field_type" class="form-control" onchange="onChangeFieldType(this)">
                    @foreach($arrayfieldtypes as $arrayfieldtype)
                        <option value="{{$arrayfieldtype['key']}}">{{$arrayfieldtype['value']}}</option>
                    @endforeach
                </select>
                {!! $errors->first('field_type', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20 deafault_value">
                <label>
                    @lang('validation.attributes.deafault_value')
                    {{-- <span class="text-danger">*</span> --}}
                </label>
                <div class="deafault_value_input">
                    {!! Form::text('deafault_value', $customfield->sequence, ['class' => 'form-control']) !!}
                </div>
                {!! $errors->first('deafault_value', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20 items_value" style="display:none">
                <label>
                    @lang('validation.attributes.items')
                    {{-- <span class="text-danger">*</span> --}}
                </label>
                <div class="items_value_input">
                    {!! Form::text('items', $customfield->sequence, ['class' => 'form-control']) !!}
                </div>
                {!! $errors->first('items', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20 max_length">
                <label>
                    @lang('validation.attributes.max_length')
                    {{-- <span class="text-danger">*</span> --}}
                </label>
                {!! Form::number('max_length', $customfield->sequence, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '1']) !!}
                {{-- {!! $errors->first('max_length', '<p class="text-danger">:message</p>') !!} --}}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.sequence')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::number('sequence', $customfield->sequence, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '0']) !!}
                {!! $errors->first('sequence', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>

        <div class="form-material row">
            
            <div class="col-md-6 m-t-20">
                <input type="checkbox" class="check" name="mandatory" id="mandatory">
                <label for="mandatory">
                    Mandatory
                </label>
            </div>

            <div class="col-md-6 m-t-20">
                <input type="checkbox" class="check" name="show_in_report" id="show_in_report" checked="checked">
                <label for="show_in_report">
                    Show In Report
                </label>
            </div>

            <div class="col-md-6 m-t-20">
                <input type="checkbox" class="check" name="show_in_portal" id="show_in_portal" checked="checked">
                <label for="show_in_portal">
                    Show In Portal
                </label>
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($customfield->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('fields.index') }}" class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>

@section('extra_scripts')
    <script type="text/javascript">
        function isNumber(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $('input[name="label_locale"]').keypress(function (e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode == 13) {
                e.preventDefault();
            }
            if (charCode != 8 && charCode != 0 && (charCode < 48 || charCode > 57) && charCode != 32
                && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
                return false;
            }
        });

        function onChangeFieldType(item)
        {
            $(".deafault_value_input").html('');
            $('.max_length').hide();
            $('.items_value').hide();
            
            if($(item).val() == 0 || $(item).val() == 4 || $(item).val() == 5 || $(item).val() == 6)
            {
                if($(item).val() == 0)
                {
                    $('.max_length').show();
                }
                else if($(item).val() == 4 || $(item).val() == 5)
                {
                    $('.items_value').show();
                }
                $(".deafault_value_input").html('<input class="form-control" name="deafault_value" type="text">');
            }
            else if($(item).val() == 1)
            {
                $(".deafault_value_input").html('<input class="form-control" name="deafault_value" type="text" onkeypress="return isNumber(event)"">');
            }
            else if($(item).val() == 2)
            {
                $(".deafault_value_input").html('<select name="deafault_value" class="form-control"><option value="True">True</option><option value="False">False</option></select>');
            }
            else if($(item).val() == 3)
            {
                $(".deafault_value_input").html('<input class="form-control" name="deafault_value" type="date">');
            }
        }
    </script>
@endsection