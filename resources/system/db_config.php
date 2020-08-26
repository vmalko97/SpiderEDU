<?php

$db_host = "localhost"; // Database Host
$db_user = "vmalkoyw_grad"; //  Database User
$db_password = "&Gj4K25e";  //  Database Password
$database = "vmalkoyw_grad"; // Database Name

$connection = mysqli_connect($db_host,$db_user,$db_password,$database);
mysqli_query($connection,"set names utf8");

