@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('fields.update', $field)]) !!}
        @include('fields._form')
        {!! Form::close() !!}
    </div>
@endsection
