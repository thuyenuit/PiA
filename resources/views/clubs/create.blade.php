@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('clubs.store'), 'data-toggle' => 'validator', 'role' => 'form',
        'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8']) !!}
        @include('clubs._form')
        {!! Form::close() !!}
    </div>
@endsection

@section('extra_scripts')
    <script>

        $('.dropify').dropify(dropifyOptions());
        $('.select2-multiple').select2({
            placeholder: "@lang('clubs.placeholder.select2-multiple')"
        });
        $('.select2-single').select2();

        $(document).ready(function() {
            $('#charge_club_of_quota').change(function () {
                if (this.checked) {
                    $('#monthly_payment').fadeIn('slow');
                } else {
                    $('#monthly_payment').fadeOut('slow');
                }
            });
        });
    </script>
@endsection
