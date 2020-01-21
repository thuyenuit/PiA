@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('services.store')]) !!}
        @include('services._form')
        {!! Form::close() !!}
    </div>
@endsection
