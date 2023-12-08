<?php
/**
 * Created by Paul Iyaji.
 * Date: 24/11/2023
 * Time: 08:45
 * Project Name: monis-api-homebase
 */
?>
    @include('layouts/partials/header')

    @include('layouts/partials/sidebar')
<div id=page-wrapper>
    <div class=content>
    @yield('content')
    </div>
</div>
    @include('layouts/partials/footer')

