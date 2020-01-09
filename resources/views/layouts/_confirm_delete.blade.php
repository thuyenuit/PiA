<script type="text/javascript">
    function confirmDelete(event, element) {
        event.preventDefault();
        Swal.fire({
            title: '@lang('layouts.confirm_delete.title')',
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
