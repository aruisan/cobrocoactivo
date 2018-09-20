<script>
    $(document).ready(function() {
    		toastr.options = {
			  "closeButton": true,
			  "debug": true,
			  "newestOnTop": true,
			  "progressBar": true,
			  "positionClass": "toast-top-full-width",
			  "preventDuplicates": true,
			  "showDuration": "300",
			  "hideDuration": "1000",
			  "timeOut": 0,
			  "extendedTimeOut": 0,
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut",
			  "tapToDismiss": false
			}       
		@if(Session::has('error'))
            toastr.error('{{ Session::get('error')}}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @elseif(Session::has('warning'))
            toastr.warning('{{ Session::get('warning') }}');
        @endif
    });
</script>

