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
                        <th>@lang('validation.attributes.label_locale')</th>
                        <th>@lang('validation.attributes.field_group')</th>
                        <th>@lang('validation.attributes.mandatory')</th>
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
                ajax: '{{ route('fields.index') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'field_name', name: 'field_name', },
                    {data: 'label_locale', name: 'label_locale'},
                    {data: 'field_group_name', name: 'field_group_name', className: 'text-center'},
                    {data: 'mandatory', name: 'mandatory', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'col-action'},
                ],
                //order: [[3, 'asc']], // field_group_name
                pageLength: {{ config('constants.PAGE_SIZE') }},
            };

            let buttonOptions = {
                dom: 'Bfrtlp',
                buttons: [
                    {
                        text: 'New',
                        className: 'btn-new',
                        action: function () {
                            window.location.href = '{{ route('fields.create') }}';
                        },
                    },
                    datatablesExport('Fields'),
                    datatablesColumnVisibility(),
                ],
            };

            let options = Object.assign({}, datatablesOptions(), columnOptions, buttonOptions, datatablesLanguage());
            $('.data-table').DataTable(options);
        });

        function confirmSwitchMandatory(event, element, mandatory) {
            event.preventDefault();

            Swal.fire({
                    title: mandatory == 1 ? '@lang('fields.index.switch_unmandatory')' : '@lang('fields.index.switch_mandatory')',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1e88e5',
                    cancelButtonColor: '#fc4b6c',
                    confirmButtonText: '@lang('layouts.buttons.confirm')',
                    cancelButtonText: '@lang('layouts.buttons.cancel')',
                }).then((result) => {
                    if (result.value) {
                        $(element).parent('form').submit();
                    }
                })  
        }
    </script>
@endsection
