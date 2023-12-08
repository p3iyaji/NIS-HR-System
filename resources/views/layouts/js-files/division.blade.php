<?php
/**
 * Created by Paul Iyaji.
 * Date: 29/11/2023
 * Time: 09:00
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

        $('#addNewDivision').click(function () {
            $('#addEditDivisionForm').trigger("reset");
            $('#ajaxDivisionModel').html("Add New Division");
            $('#ajax-division-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('divisions-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxDepartmentModel').html("Edit Division");
                    $('#ajax-division-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#name').val(res.message.name);
                    $('#department_id').val(res.message.department_id);

                }
            });
        });
        $('body').on('click', '.divisiondelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Division!",
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
                            url: "{{ url('divisions-delete') }}",
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
                        swal("Your Division is safe!");
                    }
                });
        });

        $('#addEditDivisionForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('divisions-store') }}",
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
                    $('#department_idError').text(res.responseJSON.errors.department_id);

                }
            });
        });

    });
</script>
<script>
    $('#ajax-division-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>




