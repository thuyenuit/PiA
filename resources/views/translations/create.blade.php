@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('translations.store')]) !!}
        @include('translations._form')
        {!! Form::close() !!}
    </div>
@endsection
