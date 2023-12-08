<?php
/**
 * Created by Paul Iyaji.
 * Date: 30/11/2023
 * Time: 07:52
 * Project Name: monis-api-homebase
 */
?>



<script>
    $(document).ready(function () {

        $('#geo_state_id').on('change', function () {
            var idState = this.value;
            $("#geo_lga_id").html('');
            $.ajax({
                url: "{{url('fetch-cities')}}",
                type: "POST",
                data: {
                    geo_state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#geo_lga_id').html('<option value="">Select LGA</option>');
                    $.each(res.cities, function (key, value) {
                        $("#geo_lga_id").append('<option  value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })
</script>
