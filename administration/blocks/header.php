<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Панель управления(".getAppName().")"; ?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../resources/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../../resources/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../../resources/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../../resources/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../../resources/assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="../../resources/assets/css/custom.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="../../resources/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="../../resources/assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/wizards/steps.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/extensions/cookie.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/core/app.js"></script>
    <script type="text/javascript" src="../../resources/assets/js/pages/form_select2.js"></script>
    <!-- /theme JS files -->
    <script type="text/javascript">
        $(function () {
            $("#refresh_timetable").click(function () {
                $.blockUI({
                    message: 'Триває оновлення розкладу CIST ' +
                    '<i class="icon-spinner4 spinner"></i><br/>' +
                    '<small>Процес може займати декілька хвилин.</small><br/>' +
                    'Будь-ласка не закривайте та не перезавантажуйте сторінку.',
                    overlayCSS: {
                        backgroundColor: '#1b2024',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
                var ajax_function = "refresh_cist_timetable";
                $.ajax({
                    url: '../resources/system/ajax_functions.php',
                    type: "POST",
                    data: {
                        ajax_function: ajax_function,
                    },
                    success:
                        function (data) {
                        $.unblockUI();
                        if (data == "ERROR") {
                            swal({
                                title: "Помилка",
                                text: "Конфігурацію не змінено",
                                type: "error",
                            });
                        } else if (data == "OK") {
                            swal({
                                title: "Успіх",
                                text: "Розклад CIST Оновлено",
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

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand"><img src="../../resources/assets/images/logotype.png" /></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

        </ul>

        <p class="navbar-text">Останнє оновлення розкладу CIST: <span class="label bg-success"><?php echo getCistTimetableUpdateTime();?></span>&nbsp;<span id="refresh_timetable" class="text text-white"><i class="icon icon-spinner9"></i></span></p>

        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../../resources/assets/images/placeholder.jpg" alt="">
                    <span>Admin</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="?page=edit_profile"><i class="icon-profile"></i> Профіль</a></li>
                    <li><a href="?page=logout"><i class="icon-switch2"></i> Вихід</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">