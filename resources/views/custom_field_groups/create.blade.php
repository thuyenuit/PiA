@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('customfieldgroups.store')]) !!}
        @include('custom_field_groups._form')
        {!! Form::close() !!}
    </div>
@endsection
