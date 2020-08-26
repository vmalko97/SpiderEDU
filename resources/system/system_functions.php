<?php

function getAdminPanelPageName($page)
{
    switch ($page) {
        case 'main' :
            $result = 'Головна';
            break;
        case 'add_auditory' :
            $result = 'Додавання аудиторії';
            break;
        case 'add_event' :
            $result = 'Додавання події';
            break;
        case 'add_it_professional' :
            $result = 'Додавання IT-Професіонала';
            break;
        case 'add_student' :
            $result = 'Додавання студента';
            break;
        case 'add_teacher' :
            $result = 'Додавання викладача';
            break;
        case 'add_to_timetable' :
            $result = 'Додавання події до розкладу';
            break;
        case 'all_teachers' :
            $result = 'Всі викладачі/IT-Професіонали';
            break;
        case 'all_students':
            $result = 'Всі студенти';
            break;
        case 'edit_config' :
            $result = 'Налаштування конфігурації';
            break;
        case 'edit_timetable_period' :
            $result = 'Редагування події';
            break;
        case 'timetable':
            $result = 'Розклад';
            break;
        case 'events_moderation':
            $result = 'Модерація подій';
            break;
        case 'all_events':
            $result = 'Всі події';
            break;
        case 'telegram_moderation':
            $result = 'Модерація груп/каналів Telegram';
            break;
        case 'all_telegram_channels':
            $result = 'Всі Telegram канали/групи';
            break;
        case 'messages':
            $result = 'Повідомлення';
            break;
        case 'edit_student':
            $result = "Редагування студента";
            break;
        case 'edit_teacher':
            $result = "Редагування викладача/IT-професіонала";
            break;
        case 'auditories':
            $result = "Список аудиторій";
            break;
        case 'edit_event':
            $result = "Редагування події";
            break;
        case 'my_events':
            $result = "Мої події";
            break;
        case 'event_records_moderation':
            $result = "Модерація записів на подію";
            break;
        case 'edit_profile':
            $result = "Редагування профілю";
            break;
        case 'event_timetable':
            $result = "Розклад занять";
            break;
        case 'edit_wp_config':
            $result = "Налаштування конфігурації WordPress блогу";
            break;
        case 'marks':
            $result = "Оцінки";
            break;
        case 'digital_journal':
            $result = "Електронний журнал";
            break;
        case 'student_info':
            $result = "Інформація про студента";
            break;
        case 'sandbox' :
            $result = 'Пісочниця';
            break;
        default:
            $result = 'Помилка 404';
    }
    return $result;
}

function getStudentPageName($page)
{
    switch ($page) {
        case 'main' :
            $result = 'Головна';
            break;
        case 'messages':
            $result = 'Повідомлення';
            break;
        case 'my_events':
            $result = 'Мої події';
            break;
        case 'events':
            $result = 'Список подій';
            break;
        case 'sign_up_to_event':
            $result = 'Запис на подію';
            break;
        case 'edit_profile':
            $result = "Редагування профілю";
            break;
        case 'digital_journal':
            $result = "Електронний журнал";
            break;
        case 'timetable':
            $result = 'Розклад';
            break;
        default:
            $result = 'Помилка 404';
    }
    return $result;
}

function getTeacherPageName($page)
{
    switch ($page) {
        case 'main':
            $result = "Головна";
            break;
        case 'messages':
            $result = "Повідомлення";
            break;
        case 'create_event':
            $result = 'Створення події';
            break;
        case 'my_events':
            $result = 'Мої події';
            break;
        case 'event_moderation':
            $result = "Управління подіями";
            break;
        case 'marks':
            $result = "Оцінки";
            break;
        case 'edit_profile':
            $result = "Редагування профілю";
            break;
        case 'event_timetable':
            $result = "Розклад занять";
            break;
        case 'digital_journal':
            $result = "Електронний журнал";
            break;
        case 'cist_synchronization':
            $result = "Синхронізація розкладу з CIST";
            break;
        case 'timetable':
            $result = 'Розклад';
            break;
        case 'student_info':
           $result = "Інформація про студента";
            break;
        default:
            $result = 'Помилка 404';
    }
    return $result;
}

function getSuperAdminPhone()
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT telephone FROM super_administrators WHERE id = 1", MYSQLI_ASSOC));
    return $result['telephone'];
}

function getSuperAdministratorData()
{
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM super_administrators WHERE id = 1", MYSQLI_ASSOC);
    return $result;
}