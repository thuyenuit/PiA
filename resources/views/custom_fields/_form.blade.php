<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $customfieldgroup->id) !!}
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('label_locale', $customfieldgroup->label_locale, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('label_locale', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.sequence')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::number('sequence', $customfieldgroup->sequence, ['class' => 'form-control', 'onkeypress' => 'return isNumber(event)', 'min' => '0']) !!}
                {!! $errors->first('sequence', '<p class="text-danger">:message</p>') !!}
            </div>           
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($customfieldgroup->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('customfieldgroups.index') }}"
           class="btn btn-secondary">
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
    </script>
@endsection