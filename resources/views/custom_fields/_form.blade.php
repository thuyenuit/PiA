<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $customfield->id) !!}

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('label_locale', $customfield->label_locale, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('label_locale', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.label_locale')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('sequence', $customfield->label_locale, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('sequence', '<p class="text-danger">:message</p>') !!}
            </div> 

            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.custom_field_group')
                    <span class="text-danger">*</span>
                </label>
                <select name="custom_field_group_id"  class="form-control">
                    <option value> @lang('validation.attributes.choose_select_tag')</option>
                    @foreach($arraycfgs as $arraycfg)
                        <option value="{{$arraycfg['key']}}">{{$arraycfg['value']}}</option>
                    @endforeach  
                </select>
                {!! $errors->first('custom_field_group_id', '<p class="text-danger">:message</p>') !!}
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
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('deafault_value', $customfield->sequence, ['class' => 'form-control']) !!}
                {!! $errors->first('deafault_value', '<p class="text-danger">:message</p>') !!}
            </div> 

            <div class="form-group col-md-6 m-t-20 max_length">
                <label>
                    @lang('validation.attributes.max_length')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::number('max_length', $customfield->sequence, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '1']) !!}
                {!! $errors->first('max_length', '<p class="text-danger">:message</p>') !!}
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
                <input type="checkbox" class="check" id="show_in_report" checked="checked">
                <label for="show_in_report">
                                Show In Report
                </label>
            </div>

            <div class="col-md-6 m-t-20">
                <input type="checkbox" class="check" id="show_in_portal" checked="checked">
                <label for="show_in_portal">
                                Show In Portal
                </label>
            </div>   
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($customfield->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('customfields.index') }}" class="btn btn-secondary">
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

        function onChangeFieldType(item)
        {
            $('input[name="deafault_value"]').val('');
            $('input[name="deafault_value"]').attr('type', 'text');

            if($(item).val() > 0)
            {
                $('.max_length').hide(); 
                if($(item).val() == 3)
                {                    
                    $('input[name="deafault_value"]').attr('type', 'date');
                }
            }
            else
            {      
                $('.max_length').show();              
            }
        }
    </script>
@endsection