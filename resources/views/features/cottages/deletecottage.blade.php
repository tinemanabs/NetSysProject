<script>
    $('#deleteBtn{{ $cottage->id }}').on('click', () => {
        swal({
            title: 'Are you sure?',
            text: 'Do you want to delete this cottage?',
            icon: 'warning',
            buttons: {
                cancel: 'Cancel',
                true: 'OK'
            }
        }).then((response) => {
            let id = $('#deleteBtn{{ $cottage->id }}').data('id');
            console.log(id);
            if (response == 'true') {
                swal({
                    title: 'Success',
                    text: 'You have successfully deleted the cottage!',
                    icon: 'success'
                }).then((response) => {
                    axios.post('/deleteCottage/' + id).then(response => location.reload())

                })
            }
        })
    })
</script>
