<?php

unset($_SESSION);
session_destroy();

echo "<script>location.replace('login.php')</script>";