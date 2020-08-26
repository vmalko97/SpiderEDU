<?php
session_start();

require_once '../resources/system/db_config.php';
require_once '../resources/system/nure_api.php';
require_once '../resources/system/system_functions.php';

//Сервіси
require_once '../resources/services/configuration_service.php';
require_once '../resources/services/periods_service.php';
require_once '../resources/services/auditories_service.php';
require_once '../resources/services/timetable_service.php';
require_once '../resources/services/cist_timetable_service.php';
require_once '../resources/services/events_service.php';
require_once '../resources/services/teachers_and_it_professionals_services.php';
require_once '../resources/services/students_services.php';
require_once '../resources/services/messages_service.php';
require_once '../resources/services/digital_journal_service.php';

require_once 'blocks/header.php';
require_once 'blocks/sidebar.php';
require_once 'blocks/page_header.php';

if(isset($_SESSION['t_uid']) && $_SESSION['t_username'] && $_SESSION['t_full_name']) {

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'main' :
                require_once 'pages/main.php';
                break;
            case 'messages':
                require_once 'pages/messages.php';
                break;
            case 'create_event':
                require_once 'pages/create_event.php';
                break;
            case 'my_events':
                require_once 'pages/my_events.php';
                break;
            case 'event_moderation':
                require_once 'pages/event_moderation.php';
                break;
            case 'marks':
                require_once 'pages/marks.php';
                break;
            case 'edit_profile':
                require_once 'pages/edit_profile.php';
                break;
            case 'event_timetable':
                require_once 'pages/event_timetable.php';
                break;
            case 'digital_journal':
                require_once 'pages/digital_journal.php';
                break;
            case 'cist_synchronization':
                require_once 'pages/cist_synchronization.php';
                break;
            case 'timetable':
                require_once 'pages/timetable.php';
                break;
            case 'student_info':
                require_once 'pages/student_info.php';
                break;
            case 'logout' :
                require_once 'pages/logout.php';
                break;
            default:
                require_once 'pages/404.php';
                break;
        }
    } else {
        echo '<script type="text/javascript">location.replace("?page=main");	</script>
	<noscript><meta http-equiv="refresh" content="0; url=?page=main"></noscript>';
    }
}else{
    echo "<script type='text/javascript'>location.replace('login.php');</script>";
}

require_once 'blocks/footer.php';




