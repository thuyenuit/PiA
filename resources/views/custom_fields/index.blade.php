@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered row-border data-table" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>@lang('validation.attributes.row_index')</th>
                        <th>@lang('validation.attributes.name')</th>
                        <th>@lang('validation.attributes.custom_field_group')</th>
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
                ajax: '{{ route('customfields.index') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'label_locale', name: 'label_locale', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'col-action'},
                ],
                order: [[2, 'asc']], // sequence
                pageLength: {{ config('constants.PAGE_SIZE') }},
            };

            let buttonOptions = {
                dom: 'Bfrtlp',
                buttons: [
                    {
                        text: 'New',
                        className: 'btn-new',
                        action: function () {
                            window.location.href = '{{ route('customfields.create') }}';
                        },
                    },
                    //datatablesExport('Groups'),
                    datatablesColumnVisibility(),
                ],
            };

            let options = Object.assign({}, datatablesOptions(), columnOptions, buttonOptions, datatablesLanguage());
            $('.data-table').DataTable(options);
        });
    </script>
@endsection
