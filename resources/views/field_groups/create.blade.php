@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('field_groups.store')]) !!}
        @include('field_groups._form')
        {!! Form::close() !!}
    </div>
@endsection
