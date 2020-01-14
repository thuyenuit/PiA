@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('field_groups.update', $field_group)]) !!}
        @include('field_groups._form')
        {!! Form::close() !!}
    </div>
@endsection
