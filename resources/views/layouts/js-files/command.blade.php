<?php
/**
 * Created by Paul Iyaji.
 * Date: 29/11/2023
 * Time: 15:46
 * Project Name: monis-api-homebase
 */
?>

<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>


<script type="text/javascript">
    $(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addNewCommand').click(function () {
            $('#addEditCommandForm').trigger("reset");
            $('#ajaxCommandModel').html("Add New Command");
            $('#ajax-command-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('commands-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxCommandModel').html("Edit Command");
                    $('#ajax-command-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#command').val(res.message.command);


                }
            });
        });
        $('body').on('click', '.commanddelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Command!",
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
                            url: "{{ url('commands-delete') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
                            },
                            dataType: 'json',
                            success: function (res) {
                                    if(res.status == 405){
                                        swal('Error', res.message, 'error');
                                    }else{
                                        swal('Success', res.message, 'success');
                                    }

                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Command is safe!");
                    }
                });
        });

        $('#addEditCommandForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('commands-store') }}",
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
                    $('#commandError').text(res.responseJSON.errors.command);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-command-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


