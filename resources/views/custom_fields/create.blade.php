@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')
    <div class="page-content">
        {!! Form::open(['url' => route('customfields.store')]) !!}
        @include('custom_fields._form')
        {!! Form::close() !!}
    </div>
@endsection
