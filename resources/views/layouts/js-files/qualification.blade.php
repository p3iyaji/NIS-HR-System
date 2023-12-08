<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 12:05
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

        $('#addNewqualification').click(function () {
            $('#addEditqualificationForm').trigger("reset");
            $('#ajaxqualificationModel').html("Add a New Qualification");
            $('#ajax-qualification-model').modal('show');
        });

        $('body').on('click', '.qualificationedit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('qualifications-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxqualificationModel').html("Edit Qualification");
                    $('#ajax-qualification-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#institution').val(res.message.institution);
                    $('#certificate_obtained').val(res.message.certificate_obtained);
                    $('#start_date').val(res.message.start_date);
                    $('#end_date').val(res.message.end_date);
                }
            });
        });
        $('body').on('click', '.qualificationdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Qualification!",
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
                            url: "{{ url('qualifications-delete') }}",
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
                        swal("Your Qualification is safe!");
                    }
                });
        });
        $('#addEditqualificationForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('qualifications-store') }}",
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
                    $('#institutionError').text(res.responseJSON.errors.institution);
                    $('#certificate_obtainedError').text(res.responseJSON.errors.certificate_obtained);
                    $('#start_dateError').text(res.responseJSON.errors.start_date);
                    $('#end_dateError').text(res.responseJSON.errors.end_date);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-qualification-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


