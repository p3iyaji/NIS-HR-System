<?php
/**
 * Created by Paul Iyaji.
 * Date: 30/11/2023
 * Time: 03:29
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

        $('#addNewRank').click(function () {
            $('#addEditRankForm').trigger("reset");
            $('#ajaxRankModel').html("Add A New Rank");
            $('#ajax-rank-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('ranks-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxRankModel').html("Edit Rank");
                    $('#ajax-rank-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#rank').val(res.message.rank);
                    $('#grade_level').val(res.message.grade_level);

                }
            });
        });
        $('body').on('click', '.rankdelete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Rank!",
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
                            url: "{{ url('ranks-delete') }}",
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
                                }
                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Rank is safe!");
                    }
                });
        });
        $('#addEditRankForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('ranks-store') }}",
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
                    $('#rankError').text(res.responseJSON.errors.rank);
                    $('#grade_levelError').text(res.responseJSON.errors.grade_level);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-rank-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>

