<?php
require_once 'resources/system/db_config.php';
require_once 'resources/system/system_functions.php';

//Сервіси
require_once 'resources/services/configuration_service.php';

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
    <link href="resources/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="resources/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="resources/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="resources/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="resources/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="resources/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="resources/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="resources/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="resources/assets/js/core/app.js"></script>
    <script type="text/javascript" src="resources/assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <!-- /theme JS files -->
    <script type="text/javascript">

        $(function () {
            $("#submit").click(function () {
                var ajax_function = "restore_password";
                var login = $("input[name=login]").val();
                $.ajax({
                    url: 'resources/system/ajax_functions.php',
                    type: "POST",
                    data: {
                        ajax_function: ajax_function,
                        login: login,
                    },
                    success: function (data) {
                         if (data == "ERROR") {
                            swal({
                                title: "Помилка",
                                text: "Перевірте введені дані та спробуйте ще раз",
                                type: "error",
                            });
                        } else if (data == "OK") {
                            swal({
                                title: "Успіх",
                                text: "Ваш пароль відновлено. Чекайте на повідомлення з новим паролем.",
                                type: "success",
                            });
                        } else {
                            swal({
                                title: "Hacking attempt!",
                                type: "error",
                            });
                        }
                    }
                });
            });
        });

    </script>
</head>

<body class="login-container" style='background: url("/resources/assets/images/backgrounds/boxed_bg_retina.png");'>
<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand"><?php echo getAppName(); ?></a>

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
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                        <h5 class="content-group">Відновлення паролю </h5>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="login" class="form-control" placeholder="Введіть ваш логін" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button id="submit" class="btn btn-primary btn-block">Відновити <i
                                    class="icon-circle-right2 position-right"></i></button>
                    </div>
                    <p align="right"><a href="login.php">Повернутися до форми входу</a></p>
                </div>

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
