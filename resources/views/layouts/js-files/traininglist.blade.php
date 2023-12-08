<?php
/**
 * Created by Paul Iyaji.
 * Date: 06/12/2023
 * Time: 14:34
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

        $('#addNewTraininglist').click(function () {
            $('#addEditTraininglistForm').trigger("reset");
            $('#ajaxTrainingListModel').html("Add A New Training List");
            $('#ajax-traininglist-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('traininglists-edit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#ajaxTrainingListModel').html("Edit Training List");
                    $('#ajax-traininglist-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#title').val(res.message.title);
                    $('#type').val(res.message.type);

                }
            });
        });
        $('body').on('click', '.traininglistdelete', function () {
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
                            url: "{{ url('traininglists-delete') }}",
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
                        swal("Your Training List is safe!");
                    }
                });
        });
        $('#addEditTraininglistForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('traininglists-store') }}",
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
                    $('#titleError').text(res.responseJSON.errors.title);
                    $('#typeError').text(res.responseJSON.errors.type);

                }
            });
        });

    });
</script>

<script>
    $('#ajax-traininglist-model').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>


