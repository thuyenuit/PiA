@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('fields.store')]) !!}
        @include('fields._form')
        {!! Form::close() !!}
    </div>
@endsection
