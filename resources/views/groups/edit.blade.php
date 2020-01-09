@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        {!! Form::open(['method' => 'PATCH', 'url' => route('groups.update', $group)]) !!}
        @include('groups._form')
        {!! Form::close() !!}
    </div>
@endsection

{{--@section('extra_scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        jQuery(document).ready(function(){--}}
{{--            var groupItem = {!! $group !!};--}}

{{--            if (typeof(groupItem) != 'undefined' &&  groupItem !== null) {--}}
{{--                if (groupItem['builtin'] == true ) {--}}
{{--                    $('#group-name').attr("disabled", true);--}}
{{--                    $('#group-description').attr("disabled", true);--}}
{{--                    $('#submit-button').attr("disabled", true);--}}
{{--                } else {--}}
{{--                    $('#group-name').attr("disabled", false);--}}
{{--                    $('#group-description').attr("disabled", false);--}}
{{--                    $('#submit-button').attr("disabled", false);--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
