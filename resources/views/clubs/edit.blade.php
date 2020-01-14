@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH','url' => route('clubs.update', $club), 'data-toggle' => 'validator', 'role' => 'form',
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
    </script>
@endsection
