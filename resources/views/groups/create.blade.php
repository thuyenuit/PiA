@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('groups.store')]) !!}
        @include('groups._form')
        {!! Form::close() !!}
    </div>
@endsection
