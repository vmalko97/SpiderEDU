<?php
session_start();

require_once 'resources/system/db_config.php';
require_once 'resources/system/system_functions.php';
require_once 'resources/system/nure_api.php';


//Сервіси
require_once 'resources/services/configuration_service.php';
require_once 'resources/services/auditories_service.php';
require_once 'resources/services/periods_service.php';
require_once 'resources/services/messages_service.php';
require_once 'resources/services/events_service.php';
require_once 'resources/services/teachers_and_it_professionals_services.php';
require_once 'resources/services/students_services.php';
require_once 'resources/services/digital_journal_service.php';
require_once 'resources/services/timetable_service.php';

require_once 'resources/pageparts/header.php';
require_once 'resources/pageparts/sidebar.php';
require_once 'resources/pageparts/page_header.php';

if (isset($_SESSION['uid']) && $_SESSION['username'] && $_SESSION['full_name']) {
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'main' :
                require_once 'resources/pages/main.php';
                break;
            case 'logout' :
                require_once 'resources/pages/logout.php';
                break;
            case 'messages':
                require_once 'resources/pages/messages.php';
                break;
            case 'sign_up_to_event':
                require_once 'resources/pages/sign_up_to_event.php';
                break;
            case 'events':
                require_once 'resources/pages/events.php';
                break;
            case 'my_events':
                require_once 'resources/pages/my_events.php';
                break;
            case 'digital_journal':
                require_once 'resources/pages/digital_journal.php';
                break;
            case 'timetable':
                require_once 'resources/pages/timetable.php';
                break;
            case 'edit_profile':
                require_once 'resources/pages/edit_profile.php';
                break;
            default:
                require_once 'resources/pages/404.php';
                break;
        }
    } else {
        echo "<script>location.replace('/?page=main')";
    }
} else {
    echo "<script>location.replace('login.php');</script>";
}

require_once 'resources/pageparts/footer.php';




