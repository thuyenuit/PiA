@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('fields.update', $field, $array_field_groups, $array_field_types)]) !!}
        @include('fields._form')
        {!! Form::close() !!}
    </div>
@endsection
