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
    <title><?php echo getAppName() . "- Реєстрація"; ?></title>

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
        function register() {
            var ajax_function = "add_student";
            var login = $("input[name=login]").val();
            var password = 123456;
            var full_name = $("input[name=full_name]").val();
            var study_place = $("input[name=study_place]").val();
            var working_place = $("input[name=working_place]").val();
            var telephone = $("input[name=phone]").val();
            var email = $("input[name=email]").val();
            var skype = $("input[name=skype]").val();
            var telegram = $("input[name=telephone]").val();
            var address = $("input[name=address]").val();
            $.ajax({
                url: 'resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    login: login,
                    password: password,
                    full_name: full_name,
                    study_place: study_place,
                    working_place: working_place,
                    telephone: telephone,
                    email: email,
                    skype: skype,
                    telegram: telegram,
                    address: address,
                },
                success: function (data) {
                    if (data == "ERROR") {
                        swal({
                            title: "Помилка",
                            text: "Введені не всі дані. Спробуйте ще раз.",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Ви зареєструвались успішно",
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
        }
        function student_login_verify() {
            var ajax_function = "student_login_verify";
            var login = $("input[name=login]").val();
            $.ajax({
                url: 'resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    login:login
                },
                success: function (data) {
                    if (data == "ERROR") {
                        $("#login_notify").removeClass('text-success').addClass('text-danger');
                        $("#login_notify").html("Логін зайнятий");
                    } else if (data == "OK") {
                        $("#login_notify").removeClass('text-danger').addClass('text-success');
                        $("#login_notify").html("Логін вільний");
                        $("#submit").prop("disabled", false);
                    } else {
                        $("#tg_notify").html("Hacking attempt!");
                    }
                }
            });
        }
        function tg_ver() {

                var ajax_function = "telegram_verify_number";
                var phone = $("input[name=phone]").val();
                $.ajax({
                    url: 'resources/system/ajax_functions.php',
                    type: "POST",
                    data: {
                        ajax_function: ajax_function,
                        phone: phone
                    },
                    success: function (data) {
                        if (data == "ERROR") {
                            $("#tg_notify").removeClass('label-success').addClass('label-danger');
                            $("#tg_notify").html("Ваш телефон ще не зареєстровано в системі, будь-ласка авторизуйтесть в Telegram боті @studygradbot." +
                                "Ta відправте йому свій номер через контекстне меню чи за допомогою команди <code>PHONE+380XXXXXXXXX</code>");
                        } else if (data == "OK") {
                            $("#tg_notify").removeClass('label-danger').addClass('label-success');
                            $("#tg_notify").html("Телефон зареєстровано успішно");
                            $("#submit").prop("disabled", false);
                        } else {
                            $("#tg_notify").html("Hacking attempt!");
                        }
                    }
                });
        }
        function verify() {
            $("#phone").prop("disabled", true);
            $("#verify").hide();
            $("#tg_notify").show();
            setInterval(tg_ver,1000);
        }

    </script>
</head>

<body class="login-container" style='background: url("/resources/assets/images/backgrounds/boxed_bg_retina.png");'>
<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand"><img src="resources/assets/images/logotype.png"/></a>

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
                        <h5 class="content-group">Реєстрація в системі
                        </h5>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="login" class="form-control" onkeyup="student_login_verify()" placeholder="Логін" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                        <p align="right" class="text text-danger" id="login_notify"></p>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="full_name" class="form-control" placeholder="ПІБ" required>
                        <div class="form-control-feedback">
                            <i class="icon-profile text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="working_place" class="form-control" placeholder="Місце роботи" required>
                        <div class="form-control-feedback">
                            <i class="icon-hammer text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="study_place" class="form-control" placeholder="Місце навчання" required>
                        <div class="form-control-feedback">
                            <i class="icon-book text-muted"></i>
                        </div>
                    </div>


                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="email" class="form-control" placeholder="E-Mail" required>
                        <div class="form-control-feedback">
                            <i class="icon-envelop text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="skype" class="form-control" placeholder="Skype" required>
                        <div class="form-control-feedback">
                            <i class="icon-skype text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" name="address" class="form-control" placeholder="Домашня адреса" required>
                        <div class="form-control-feedback">
                            <i class="icon-home text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="tel" id="phone" name="phone" class="form-control"
                               placeholder="Номер телефону (380XXXXXXXXX)" required>
                        <div class="form-control-feedback">
                            <i class="icon-mobile text-muted"></i>
                        </div>
                        <div id="tg_notify" class="well well-sm text-left" hidden></div>
                        <a class="btn btn-xs btn-block btn-success" id="verify" onclick="verify()">Підтвердити телефон</a>
                    </div>
                    <div class="form-group">
                        <button id="submit" onclick="register()" class="btn btn-primary btn-block" disabled>Зареєструватись <i
                                    class="icon-circle-right2 position-right"></i></button>
                    </div>
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
