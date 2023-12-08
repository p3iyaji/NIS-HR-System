<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 05:41
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

        $('#addNewdeployment').click(function () {
            $('#addEditdeploymentForm').trigger("reset");
            $('#ajaxdeploymentModel').html("Add A New deployment");
            $('#ajax-deployment-model').modal('show');
        });

        $('body').on('click', '.deploymentedit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('deployments-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxdeploymentModel').html("Edit deployment");
                    $('#ajax-deployment-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#current_location').val(res.message.current_location);
                    $('#location_of_deployment').val(res.message.location_of_deployment);
                    $('#deployment_date').val(res.message.deployment_date);
                    $('#authorized_by').val(res.message.authorized_by);
                    $('#reason').val(res.message.reason);

                }
            });
        });
        $('body').on('click', '.deploymentdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this deployment!",
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
                            url: "{{ url('deployments-delete') }}",
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
                        swal("Your deployment is safe!");
                    }
                });
        });
        $('#addEditdeploymentForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('deployments-store') }}",
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
                    $('#current_locationError').text(res.responseJSON.errors.current_location);
                    $('#location_of_deploymentError').text(res.responseJSON.errors.location_of_deployment);
                    $('#deployment_dateError').text(res.responseJSON.errors.deployment_date);
                    $('#reasonError').text(res.responseJSON.errors.reason);
                    $('#authorized_byError').text(res.responseJSON.errors.authorized_by);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-deployment-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>

