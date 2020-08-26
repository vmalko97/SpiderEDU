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
require_once '../resources/services/telegram_bot_service.php';
require_once '../resources/services/messages_service.php';
require_once '../resources/services/digital_journal_service.php';

require_once 'blocks/header.php';
require_once 'blocks/sidebar.php';
require_once 'blocks/page_header.php';

if (isset($_SESSION['admin_login'])) {

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'main' :
                require_once 'pages/main.php';
                break;
            case 'add_teacher':
                require_once 'pages/add_teacher.php';
                break;
            case 'all_teachers':
                require_once 'pages/all_teachers.php';
                break;
            case 'all_students':
                require_once 'pages/all_students.php';
                break;
            case 'all_events':
                require_once 'pages/all_events.php';
                break;
            case 'add_it_professional':
                require_once 'pages/add_it_professional.php';
                break;
            case 'add_student':
                require_once 'pages/add_student.php';
                break;
            case 'add_event':
                require_once 'pages/add_event.php';
                break;
            case "add_auditory":
                require_once 'pages/add_auditory.php';
                break;
            case 'timetable':
                require_once 'pages/timetable.php';
                break;
            case 'add_to_timetable':
                require_once 'pages/add_to_timetable.php';
                break;
            case 'edit_timetable_period':
                require_once 'pages/edit_timetable_period.php';
                break;
            case 'edit_config':
                require_once 'pages/edit_config.php';
                break;
            case 'events_moderation':
                require_once 'pages/events_moderation.php';
                break;
            case 'telegram_moderation':
                require_once 'pages/telegram_moderation.php';
                break;
            case 'all_telegram_channels':
                require_once 'pages/all_telegram_channels.php';
                break;
            case 'messages':
                require_once 'pages/messages.php';
                break;
            case 'edit_student':
                require_once 'pages/edit_student.php';
                break;
            case 'edit_teacher':
                require_once 'pages/edit_teacher.php';
                break;
            case 'auditories':
                require_once 'pages/auditories.php';
                break;
            case 'edit_event':
                require_once 'pages/edit_event.php';
                break;
            case 'my_events':
                require_once 'pages/my_events.php';
                break;
            case 'event_records_moderation':
                require_once 'pages/event_records_moderation.php';
                break;
            case 'edit_profile':
                require_once 'pages/edit_profile.php';
                break;
            case 'event_timetable':
                require_once 'pages/event_timetable.php';
                break;
            case 'marks':
                require_once 'pages/marks.php';
                break;
            case 'edit_wp_config':
                require_once 'pages/edit_wp_config.php';
                break;
            case 'digital_journal':
                require_once  'pages/digital_journal.php';
                break;
            case 'student_info':
                require_once 'pages/student_info.php';
                break;
            case 'sandbox':
                require_once 'pages/sandbox.php';
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
} else {
    echo "<script type='text/javascript'>location.replace('auth.php');</script>";
}

require_once 'blocks/footer.php';




