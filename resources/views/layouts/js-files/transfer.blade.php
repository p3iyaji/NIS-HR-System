<?php
/**
 * Created by Paul Iyaji.
 * Date: 06/12/2023
 * Time: 13:18
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

        $('#addNewTransfer').click(function () {
            $('#addEdittransferForm').trigger("reset");
            $('#ajaxtransferModel').html("Add A New transfer");
            $('#ajax-transfer-model').modal('show');
        });

        $('body').on('click', '.transferedit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('transfers-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxtransferModel').html("Edit transfer");
                    $('#ajax-transfer-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#current_location').val(res.message.current_location);
                    $('#new_location').val(res.message.new_location);
                    $('#transfer_date').val(res.message.transfer_date);
                    $('#authorized_by').val(res.message.authorized_by);
                    $('#reason').val(res.message.reason);

                }
            });
        });
        $('body').on('click', '.transferdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this transfer!",
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
                            url: "{{ url('transfers-delete') }}",
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
                        swal("Your transfer is safe!");
                    }
                });
        });
        $('#addEdittransferForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('transfers-store') }}",
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
                    $('#authorized_byError').text(res.responseJSON.errors.authorized_by);
                    $('#employee_idError').text(res.responseJSON.errors.employee_id);
                    $('#current_locationError').text(res.responseJSON.errors.current_location);
                    $('#new_locationError').text(res.responseJSON.errors.new_location);
                    $('#transfer_dateError').text(res.responseJSON.errors.transfer_date);
                    $('#reasonError').text(res.responseJSON.errors.reason);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-transfer-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>

