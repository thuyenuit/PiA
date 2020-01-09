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
                        <th>
                            @lang('validation.attributes.lang_key')
                            @lang('translations.hints.lang_key')
                        </th>
                        <th>
                            @lang('validation.attributes.flag')
                            @lang('translations.hints.flag')
                        </th>
                        <th>@lang('validation.attributes.is_primary')</th>
                        <th>@lang('validation.attributes.label')</th>
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
                ajax: '{{ route('translations.index') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'lang_key', name: 'lang_key'},
                    {data: 'flag', name: 'flag'},
                    {data: 'primary', name: 'primary', className: 'text-center'},
                    {data: 'label', name: 'label'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'col-action'},
                ],
                order: [[1, 'asc']], // column lang_key
                pageLength: {{ config('constants.PAGE_SIZE') }},
            };

            let buttonOptions = {
                dom: 'Bfrtlp',
                buttons: [
                    {
                        text: 'New',
                        className: 'btn-new',
                        action: function () {
                            window.location.href = '{{ route('translations.create') }}';
                        },
                    },
                    datatablesExport('Languages'),
                    datatablesColumnVisibility(),
                ],
            };

            let options = Object.assign({}, datatablesOptions(), columnOptions, buttonOptions, datatablesLanguage());
            $('.data-table').DataTable(options);
        });

        function confirmSwitchPrimary(event, element) {
            event.preventDefault();
            Swal.fire({
                title: '@lang('translations.index.switch_primary')',
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
