<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 09:55
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

        $('#addNewdiscipline').click(function () {
            $('#addEditdisciplineForm').trigger("reset");
            $('#ajaxdisciplineModel').html("Add A New discipline");
            $('#ajax-discipline-model').modal('show');
        });

        $('body').on('click', '.disciplineedit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('disciplines-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxdisciplineModel').html("Edit discipline");
                    $('#ajax-discipline-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#offence_desc').val(res.message.offence_desc);
                    $('#action_taken').val(res.message.action_taken);
                    $('#reported_by').val(res.message.reported_by);
                }
            });
        });
        $('body').on('click', '.disciplinedelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this discipline!",
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
                            url: "{{ url('disciplines-delete') }}",
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
                        swal("Your discipline is safe!");
                    }
                });
        });
        $('#addEditdisciplineForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('disciplines-store') }}",
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
                    $('#offence_descError').text(res.responseJSON.errors.offence_desc);
                    $('#action_takenError').text(res.responseJSON.errors.action_taken);
                    $('#reported_byError').text(res.responseJSON.errors.reported_by);
                }
            });
        });

    });
</script>

<script>
    $('#ajax-discipline-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>



