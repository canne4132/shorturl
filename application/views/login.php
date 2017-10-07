<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<form action="/User/userlogin" method="post">
    <input type="text" placeholder="请输入登录名" name="username">
    <input type="password" placeholder="请输入密码" name="password">
    <input type="submit" value="登录">
</form>
</body>
</html>
