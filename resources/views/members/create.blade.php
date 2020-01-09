@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['url' => route('members.index')]) !!}
        @include('members._form')
        {!! Form::close() !!}
    </div>
@endsection

