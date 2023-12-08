<?php
/**
 * Created by Paul Iyaji.
 * Date: 24/11/2023
 * Time: 09:25
 * Project Name: monis-api-homebase
 */
?>

<script>
    $(document).ready(function () {

        "use strict"; // Start of use strict

        $('#dataTableExample1').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [[6, 25, 50, -1], [6, 25, 50, "All"]],
            "iDisplayLength": 6
        });

        $("#dataTableExample2").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

    });
</script>
        @include('layouts/js-files/command')
        @include('layouts/js-files/office')
        @include('layouts/js-files/department')
        @include('layouts/js-files/division')
        @include('layouts/js-files/unit')
        @include('layouts/js-files/rank')
        @include('layouts/js-files/designation')
        @include('layouts/js-files/employee')
        @include('layouts/js-files/leavetype')
        @include('layouts/js-files/leave')
        @include('layouts/js-files/traininglist')
        @include('layouts/js-files/training')
        @include('layouts/js-files/transfer')
        @include('layouts/js-files/deployment')
        @include('layouts/js-files/promotion')
        @include('layouts/js-files/discipline')
        @include('layouts/js-files/certification')
        @include('layouts/js-files/qualification')
</body>

<!-- Mirrored from thememinister.com/adminpage/theme/adminpage_v2.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Nov 2023 18:28:56 GMT -->
</html>


