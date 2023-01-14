<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'success') }}";
    switch(type){
        case 'success':
            Swal.fire({
                    title: 'Felicitări!',
                    html: '{{ Session::get('message') }}',
                    icon: 'success',
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            break;

        case 'warning':
            Swal.fire({
                    title: 'Avertisment!',
                    html: '{{ Session::get('message') }}',
                    icon: 'warning',
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            break;

        case 'error':
                Swal.fire({
                    title: 'Eroare!',
                    html: '{{ Session::get('message') }}',
                    icon: 'error',
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            break;
    }
    @endif
</script>
