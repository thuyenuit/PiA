@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs', ['breadcrumbs' => $breadcrumbs])

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('members.update', $user)]) !!}
        @include('members._form')
        {!! Form::close() !!}
    </div>
@endsection
