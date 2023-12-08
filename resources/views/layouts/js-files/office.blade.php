<?php
/**
 * Created by Paul Iyaji.
 * Date: 26/11/2023
 * Time: 13:03
 * Project Name: monis-api-homebase
 */
?>


<!-- Bootstrap core JavaScript-->

<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>


<script type="text/javascript">
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addNewOffice').click(function () {
            $('#addEditOfficeForm').trigger("reset");
            $('#ajaxOfficeModel').html("Add A New Office");
            $('#ajax-office-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('offices-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                    },
                dataType: 'json',
                success: function(res){
                    $('#ajaxOfficeModel').html("Edit Office");
                    $('#ajax-office-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#name').val(res.message.name);
                    $('#command_id').val(res.message.command_id);
                    $('#location').val(res.message.location);

                }
            });
        });
        $('body').on('click', '.officedelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Office!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).data('id');

                        // ajax
                        $.ajax({
                            type: "POST",
                            url: "{{ url('offices-delete') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                },
                            dataType: 'json',
                            success: function (res) {
                                console.log(res);
                                if(res.status == 405){
                                    swal('Error', res.message, 'error');
                                }else{
                                    swal('Success', res.message, 'success');
                                }                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Office is safe!");
                    }
                });
        });
        $('#addEditOfficeForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('offices-store') }}",
                data: formData,
                contentType: false,
                processData: false,

                dataType: 'json',
                success: function(res){
                    console.log(res);
                    window.location.reload();
                    $("#btn-save").html('Submit');
                    $("#btn-save"). attr("disabled", false);
                },
                error: function(res){
                    $('#nameError').text(res.responseJSON.errors.name);
                    $('#command_idError').text(res.responseJSON.errors.command_id);
                    $('#locationError').text(res.responseJSON.errors.location);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-office-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>

