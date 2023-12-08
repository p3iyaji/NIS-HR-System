<?php
/**
 * Created by Paul Iyaji.
 * Date: 24/11/2023
 * Time: 00:06
 * Project Name: monis-api-homebase
 */
?>
<h1>Forget Password Email</h1>

You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
