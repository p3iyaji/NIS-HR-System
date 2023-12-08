<?php
/**
 * Created by Paul Iyaji.
 * Date: 06/12/2023
 * Time: 17:18
 * Project Name: monis-api-homebase
 */
?>

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

        $('#addNewTraining').click(function () {
            $('#addEditTrainingForm').trigger("reset");
            $('#ajaxTrainingModel').html("Add A New Training");
            $('#ajax-training-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('trainings-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxTrainingModel').html("Edit Training");
                    $('#ajax-training-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#training_list_id').val(res.message.training_list_id);
                    $('#training_institute').val(res.message.training_institute);
                    $('#training_duration').val(res.message.training_duration);
                    $('#training_location').val(res.message.training_location);
                    $('#training_start_date').val(res.message.training_start_date);
                    $('#training_end_date').val(res.message.training_end_date);
                }
            });
        });
        $('body').on('click', '.trainingdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Training!",
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
                            url: "{{ url('trainings-delete') }}",
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
                        swal("Your Training is safe!");
                    }
                });
        });
        $('#addEditTrainingForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('trainings-store') }}",
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
                    $('#training_list_idError').text(res.responseJSON.errors.training_list_id);
                    $('#training_locationError').text(res.responseJSON.errors.training_location);
                    $('#training_durationError').text(res.responseJSON.errors.training_duration);
                    $('#training_start_dateError').text(res.responseJSON.errors.training_start_date);
                    $('#training_end_dateError').text(res.responseJSON.errors.training_end_date);
                    $('#training_instituteError').text(res.responseJSON.errors.training_institute);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-training-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>



