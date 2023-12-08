<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 06:45
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

        $('#addNewpromotion').click(function () {
            $('#addEditpromotionForm').trigger("reset");
            $('#ajaxpromotionModel').html("Add A New promotion");
            $('#ajax-promotion-model').modal('show');
        });

        $('body').on('click', '.promotionedit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('promotions-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxpromotionModel').html("Edit promotion");
                    $('#ajax-promotion-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#employee_id').val(res.message.employee_id);
                    $('#old_rank').val(res.message.old_rank);
                    $('#new_rank').val(res.message.new_rank);
                    $('#old_job_title').val(res.message.old_job_title);
                    $('#new_job_title').val(res.message.new_job_title);
                    $('#promotion_date').val(res.message.promotion_date);
                    $('#rank_duration').val(res.message.rank_duration);
                    $('#next_promotion_due_date').val(res.message.next_promotion_due_date);

                    console.log(res.message.promotion_date);
                }
            });
        });
        $('body').on('click', '.promotiondelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this promotion!",
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
                            url: "{{ url('promotions-delete') }}",
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
                        swal("Your promotion is safe!");
                    }
                });
        });
        $('#addEditpromotionForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('promotions-store') }}",
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
                    $('#old_rankError').text(res.responseJSON.errors.old_rank);
                    $('#new_rankError').text(res.responseJSON.errors.new_rank);
                    $('#old_job_titleError').text(res.responseJSON.errors.old_job_title);
                    $('#new_job_titleError').text(res.responseJSON.errors.new_job_title);
                    $('#rank_durationError').text(res.responseJSON.errors.rank_duration);
                    $('#promotion_dateError').text(res.responseJSON.errors.promotion_date);
                    $('#next_promotion_due_dateError').text(res.responseJSON.errors.next_promotion_due_date);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-promotion-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


