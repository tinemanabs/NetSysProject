<script>
    $('#deleteBtn{{ $room->id }}').on('click', () => {
        swal({
            title: 'Are you sure?',
            text: 'Do you want to delete this room?',
            icon: 'warning',
            buttons: {
                cancel: 'Cancel',
                true: 'OK'
            }
        }).then((response) => {
            let id = $('#deleteBtn{{ $room->id }}').data('id');
            console.log(id);
            if (response == 'true') {
                swal({
                    title: 'Success',
                    text: 'You have successfully deleted the room!',
                    icon: 'success'
                }).then((response) => {
                    axios.post('/deleteRoom/' + id).then(response => location.reload())

                })
            }
        })
    })
</script>
