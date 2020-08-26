<?php
session_destroy();
echo "<script>location.replace('/administration/auth.php');</script>";