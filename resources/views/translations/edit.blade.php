@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('translations.update', $language)]) !!}
        @include('translations._form')
        {!! Form::close() !!}
    </div>
@endsection
