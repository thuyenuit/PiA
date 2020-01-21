<div class="card">
    <div class="card-body">
        <div class="form-material row">
            {!! Form::hidden('id', $service->id) !!}
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.name')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('name', $service->name, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>
                    @lang('validation.attributes.locale_key')
                    <span class="text-danger">*</span>
                </label>
                {!! Form::text('locale_key', $service->locale_key, ['class' => 'form-control', 'maxlength' => '191']) !!}
                {!! $errors->first('locale_key', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        {!! Form::submit(isset($service->id) ? __('layouts.buttons.update') : __('layouts.buttons.create'),
            ['class' => 'btn btn-success']) !!}
        <a href="{{ route('services.index') }}"
           class="btn btn-secondary">
            @lang('layouts.buttons.cancel')
        </a>
    </div>
</div>

@section('extra_scripts')
    <script type="text/javascript">
        $('input[name="locale_key"]').on('input', function (e) {
            $(this).val($(this).val().replace(/[^A-Za-z0-9_]/g, ''));
        });
    </script>
@endsection
