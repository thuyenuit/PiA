@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('customfieldgroups.update', $customfieldgroup)]) !!}
        @include('custom_field_groups._form')
        {!! Form::close() !!}
    </div>
@endsection
