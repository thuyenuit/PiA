@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h4>{{ $group->name }}</h4>
                @if(!empty($group->description))
                    <h6>{{ $group->description }}</h6>
                @endif

                <table class="table table-hover table-bordered row-border data-table" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>@lang('validation.attributes.row_index')</th>
                        <th>@lang('validation.attributes.name')</th>
                        <th>@lang('validation.attributes.email')</th>
                        <th>@lang('validation.attributes.club_id')</th>
                        <th class="col-action">@lang('validation.attributes.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extra_scripts')
    <script type="text/javascript">
        $(function () {
            let columnOptions = {
                ajax: '{{ route('groups.users.index', $group) }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'club', name: 'club'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'col-action'},
                ],
                order: [[1, 'asc']], // column Name
                pageLength: {{ config('constants.PAGE_SIZE') }},
            };

            let buttonOptions = {
                dom: 'Bfrtlp',
                buttons: [
                    {
                        text: 'New',
                        className: 'btn-new',
                        action: function () {
                            window.location.href = '{{ route('groups.users.create', $group) }}';
                        },
                    },
                    datatablesExport('Group Users'),
                    datatablesColumnVisibility(),
                ],
            };

            let options = Object.assign({}, datatablesOptions(), columnOptions, buttonOptions, datatablesLanguage());
            $('.data-table').DataTable(options);
        });
    </script>
@endsection
