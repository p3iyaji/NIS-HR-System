<?php
/**
 * Created by Paul Iyaji.
 * Date: 02/12/2023
 * Time: 13:26
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

        $('#addNewLeaveType').click(function () {
            $('#addEditLeaveTypeForm').trigger("reset");
            $('#ajaxLeaveTypeModel').html("Add New Leave Type");
            $('#ajax-leavetype-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('leavetypes-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxLeaveTypeModel').html("Edit Leave Type");
                    $('#ajax-leavetype-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#type').val(res.message.type);
                    $('#description').val(res.message.description);


                }
            });
        });
        $('body').on('click', '.leavetypedelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Leave Type!",
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
                            url: "{{ url('leavetypes-delete') }}",
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
                        swal("Your Leave Type is safe!");
                    }
                });
        });

        $('#addEditLeaveTypeForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('leavetypes-store') }}",
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
                    $('#typeError').text(res.responseJSON.errors.type);
                    $('#descriptionError').text(res.responseJSON.errors.description);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-leavetype-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


