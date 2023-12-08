<?php
/**
 * Created by Paul Iyaji.
 * Date: 28/11/2023
 * Time: 12:27
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

        $('#addNewDepartment').click(function () {
            $('#addEditDepartmentForm').trigger("reset");
            $('#ajaxDepartmentModel').html("Add New Department");
            $('#ajax-department-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('departments-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxDepartmentModel').html("Edit Department");
                    $('#ajax-department-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#name').val(res.message.name);
                    $('#description').val(res.message.description);
                    $('#office_id').val(res.message.office_id);

                }
            });
        });
        $('body').on('click', '.departmentdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Department!",
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
                            url: "{{ url('departments-delete') }}",
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
                        swal("Your Department is safe!");
                    }
                });
        });

        $('#addEditDepartmentForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('departments-store') }}",
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
                    $('#descriptionError').text(res.responseJSON.errors.description);
                    $('#office_idError').text(res.responseJSON.errors.office_id);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-department-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


