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

        $('#addNewcertification').click(function () {
            $('#addEditcertificationForm').trigger("reset");
            $('#ajaxcertificationModel').html("Add A New Certification");
            $('#ajax-certification-model').modal('show');
        });

        $('body').on('click', '.certificationedit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('certifications-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxcertificationModel').html("Edit certification");
                    $('#ajax-certification-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#certification_name').val(res.message.certification_name);
                    $('#issuing_authority').val(res.message.issuing_authority);
                    $('#date_obtained').val(res.message.date_obtained);

                }
            });
        });
        $('body').on('click', '.certificationdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Certification!",
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
                            url: "{{ url('certifications-delete') }}",
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
                        swal("Your certification is safe!");
                    }
                });
        });
        $('#addEditcertificationForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('certifications-store') }}",
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
                    $('#certification_nameError').text(res.responseJSON.errors.certification_name);
                    $('#issuing_authorityError').text(res.responseJSON.errors.issuing_authority);
                    $('#date_obtainedError').text(res.responseJSON.errors.date_obtained);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-certification-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


