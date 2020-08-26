<?php
session_start();

require_once '../resources/system/db_config.php';
require_once '../resources/system/system_functions.php';

//Сервіси
require_once '../resources/services/configuration_service.php';

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $auth_verify = mysqli_fetch_array(mysqli_query($connection, 'SELECT COUNT(*) AS count FROM super_administrators WHERE login ="' . $login . '" AND password = "' . $password . '"', MYSQLI_ASSOC));
    if ($auth_verify['count'] > 0) {
        $_SESSION['admin_login'] = $login;
        echo "<script type='text/javascript'>location.replace('index.php');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo getAppName() . "- Автентифікація"; ?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="../resources/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../resources/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../resources/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../resources/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../resources/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="../resources/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../resources/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="../resources/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="../resources/assets/js/core/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container" style='background: url("/resources/assets/images/backgrounds/notebook_bg.png"); background-size: 100% auto;'>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand"><img src="../resources/assets/images/logotype.png" /></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                <form action="auth.php" method="post">
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-cog7"></i></div>
                            <h5 class="content-group">Вхід до панелі адміністратора
                                <small class="display-block">Будь-ласка увійдіть до системи</small>
                            </h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" name="login" class="form-control" placeholder="Логін" required>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Увійти до системи <i
                                        class="icon-circle-right2 position-right"></i></button>
                        </div>
                    </div>
                </form>
                <!-- /simple login form -->


                <!-- Footer -->
                <div class="footer text-muted text-center">
                    &copy; 2018. <?php echo getAppName(); ?>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
