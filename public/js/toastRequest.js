$(document).ready(function() {
        @if(Session::has('error'))
            toastr.error('{{ Session::get('error')}}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @elseif(Session::has('warning'))
            toastr.warning('{{ Session::get('warning') }}');
        @endif
    });