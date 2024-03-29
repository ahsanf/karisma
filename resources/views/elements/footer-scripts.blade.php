@if(!empty(config('dz.public.global.js')))
@foreach(config('dz.public.global.js') as $script)
<script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach
@endif


@foreach ($data['action'] as $key => $action)
@if(!empty(config('dz.public.pagelevel.js.'.$action)))
@foreach(config('dz.public.pagelevel.js.'.$action) as $script)
<script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach
@endif
@endforeach
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script src="{{ asset('vendor/toastr/js/toastr.min.js') }}" type="text/javascript"></script>
<script>
function sweetConfirm(url, title) {
        let endpointUrl = url;
        swal({
            title: `Delete ${title} ?`,
            text: `Are you sure you want to delete ${title} ?`,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
        }).then(function(isConfirm) {
            if (isConfirm.value === true) {
                console.log(isConfirm);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    type: "post",

                    data: {
                    '_method': 'delete'
                    },
                    url: endpointUrl,
                    data: isConfirm.value,
                    statusCode: {
                        200: function(result) {
                            swal({
                                title: "Deleted !",
                                text: `${title} deleted !`,
                                type: "success",
                                showConfirmButton: false
                            }, setTimeout(function () {
                                location.reload(true);
                            }, 1700)

                            );
                        }
                    },
                    error: function(result) {
                        swal("Error !!", `Failed to delete ${title} !!`, "error")
                    }
                });
            }
        });
}
</script>
@stack('custom_js')
