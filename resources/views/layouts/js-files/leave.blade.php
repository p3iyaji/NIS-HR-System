<?php
/**
 * Created by Paul Iyaji.
 * Date: 03/12/2023
 * Time: 10:06
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

        $('#addNewLeave').click(function () {
            $('#addEditLeaveForm').trigger("reset");
            $('#ajaxLeaveModel').html("Add New Leave Request");
            $('#ajax-leave-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('leaves-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxLeaveModel').html("Edit Leave Request");
                    $('#ajax-leave-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#leave_type_id').val(res.message.leave_type_id);
                    $('#leave_days').val(res.message.leave_days);
                    $('#start_date').val(res.message.start_date);
                    $('#end_date').val(res.message.end_date);
                    $('#reason').val(res.message.reason);
                    $('#date_applied').val(res.message.date_applied);



                }
            });
        });
        $('body').on('click', '.leavedelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Leave Record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {


                        // ajax
                        $.ajax({
                            type: "POST",
                            url: "{{ url('leaves-delete') }}",
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

        $('#addEditLeaveForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('leaves-store') }}",
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
                    $('#employee_idError').text(res.responseJSON.errors.employee_id);
                    $('#leave_type_idError').text(res.responseJSON.errors.leave_type_id);
                    $('#start_dateError').text(res.responseJSON.errors.start_date);
                    $('#end_dateError').text(res.responseJSON.errors.end_date);
                    $('#leave_daysError').text(res.responseJSON.errors.leave_days);
                    $('#reasonError').text(res.responseJSON.errors.reason);
                    $('#date_appliedError').text(res.responseJSON.errors.date_applied);
                    $('#descriptionError').text(res.responseJSON.errors.description);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-leave-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>

