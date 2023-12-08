<?php
/**
 * Created by Paul Iyaji.
 * Date: 30/11/2023
 * Time: 05:23
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

        $('#addNewDesignation').click(function () {
            $('#addEditDesignationForm').trigger("reset");
            $('#ajaxDesignationModel').html("Add New Designation");
            $('#ajax-designation-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('designations-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxDesignationModel').html("Edit Designation");
                    $('#ajax-designation-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#designation').val(res.message.designation);


                }
            });
        });
        $('body').on('click', '.designationdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Designation!",
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
                            url: "{{ url('designations-delete') }}",
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
                        swal("Your Designation is safe!");
                    }
                });
        });

        $('#addEditDesignationForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('designations-store') }}",
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
                    $('#designationError').text(res.responseJSON.errors.designation);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-designation-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


