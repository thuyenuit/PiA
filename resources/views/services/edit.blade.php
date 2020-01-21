@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('services.update', $service)]) !!}
        @include('services._form')
        {!! Form::close() !!}
    </div>
@endsection

