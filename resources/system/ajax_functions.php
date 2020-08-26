<?php

require_once 'db_config.php';
require_once 'nure_api.php';

//Сервіси
require_once '../services/configuration_service.php';
require_once '../services/periods_service.php';
require_once '../services/auditories_service.php';
require_once '../services/timetable_service.php';
require_once '../services/cist_timetable_service.php';
require_once '../services/events_service.php';
require_once '../services/messages_service.php';
require_once '../services/telegram_bot_service.php';
require_once '../services/students_services.php';
require_once '../services/teachers_and_it_professionals_services.php';
require_once '../services/digital_journal_service.php';
require_once '../services/wp_posting_service.php';

switch ($_POST['ajax_function']) {

    /**
     * Додавання викладача/IT-Професіонала AJAX
     */

    case 'add_teacher':
        if (isset($_POST['login']) &&
            isset($_POST['full_name']) &&
            isset($_POST['education']) &&
            isset($_POST['job_place']) &&
            isset($_POST['position']) &&
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['address']) &&
            isset($_POST['status'])) {

            $login = filter_input(INPUT_POST, 'login');
            $password = "123456";
            $full_name = filter_input(INPUT_POST, 'full_name');
            $education = filter_input(INPUT_POST, 'education');
            $job_place = filter_input(INPUT_POST, 'job_place');
            $position = filter_input(INPUT_POST, 'position');
            $telephone = filter_input(INPUT_POST, 'telephone');
            $email = filter_input(INPUT_POST, 'email');
            $skype = filter_input(INPUT_POST, 'skype');
            $telegram = filter_input(INPUT_POST, 'telegram');
            $address = filter_input(INPUT_POST, 'address');
            $status = filter_input(INPUT_POST, 'status');
            $chat_id = TelegramGetChatId($telephone);
            $name = explode(" ", $full_name);
            if ($status == "teacher") {
                TelegramSendMessage('Вітаємо вас в системі ' . getAppName() . ', ' . $name[1] . ' ' . $name[2] . ', вас зареєстровано як викладача. Ваш логін: ' . $login . ' ваш пароль: ' . $password . '. Не забудьте змінити ваш пароль в профілі.', $chat_id);
            } else if ($status == "it_professional") {
                $chat_id = TelegramGetChatId($telephone);
                $name = explode(" ", $full_name);
                TelegramSendMessage('Вітаємо вас в системі ' . getAppName() . ', ' . $name[1] . ' ' . $name[2] . ', вас зареєстровано як IT-професіонала. Ваш логін: ' . $login . ' ваш пароль: ' . $password . '. Не забудьте змінити ваш пароль в профілі.', $chat_id);
            }
            mysqli_query($connection,
                "INSERT INTO teachers (login,password,full_name,education,job_place,position,telephone,email,skype,telegram,address,status) VALUES ('$login','" . md5($password) . "','$full_name','$education','$job_place','$position','$telephone','$email','$skype','$telegram','$address','$status')");

            echo 'OK';

        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Додавання студента AJAX
     */
    case 'add_student':
        if (isset($_POST['login']) &&
            isset($_POST['full_name']) &&
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['address'])) {

            $login = filter_input(INPUT_POST, 'login');
            $password = "123456";
            $full_name = filter_input(INPUT_POST, 'full_name');
            $study_place = filter_input(INPUT_POST, 'study_place');
            $working_place = filter_input(INPUT_POST, 'working_place');
            $telephone = filter_input(INPUT_POST, 'telephone');
            $email = filter_input(INPUT_POST, 'email');
            $skype = filter_input(INPUT_POST, 'skype');
            $telegram = filter_input(INPUT_POST, 'telegram');
            $address = filter_input(INPUT_POST, 'address');
            $chat_id = TelegramGetChatId($telephone);
            $name = explode(" ", $full_name);
            mysqli_query($connection,
                "INSERT INTO students (login,password,full_name,study_place,working_place,telephone,email,skype,telegram,address) VALUES ('$login','" . md5($password) . "','$full_name','$study_place','$working_place','$telephone','$email','$skype','$telegram','$address')");
            TelegramSendMessage('Вітаємо вас в системі ' . getAppName() . ', ' . $name[1] . '. Ваш логін: ' . $login . ' ваш пароль: ' . $password . '. Не забудьте змінити ваш пароль в профілі.', $chat_id);
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування конфігурації AJAX
     */
    case 'edit_config':
        if (isset($_POST['app_name'])) {
            $app_name = htmlspecialchars(filter_input(INPUT_POST, 'app_name'));
            $tg_bot_api_key = htmlspecialchars(filter_input(INPUT_POST, 'tg_bot_api_key'));
            mysqli_query($connection, "UPDATE configuration SET app_name = '$app_name', tg_bot_api_key = '$tg_bot_api_key' WHERE id = 1", MYSQLI_ASSOC);
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Додавання аудиторії AJAX
     */
    case 'add_auditory':
        if (isset($_POST['auditory'])) {
            $auditory = filter_input(INPUT_POST, 'auditory');
            $result = explode('@', $auditory);
            $cist_id = $result[0];
            $name = $result[1];
            mysqli_query($connection, "INSERT INTO auditories (cist_id,name) VALUES ('$cist_id','$name')");
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Оновлення розкладу CIST
     */
    case 'refresh_cist_timetable':
        truncateCistTimetable();
        $auditory_count = getAuditoriesCount();
        while ($auditory_count > 0) {
            $cist_auditory_id = getAuditoryCistIdById($auditory_count);
            $timetable = getAuditoryTimetableArray($cist_auditory_id);
            $count_events = count($timetable['events']) - 1;
            while ($count_events >= 0) {
                $count_subjects = count($timetable['subjects']);
                while ($count_subjects >= 0) {
                    if ($timetable['events'][$count_events]['subject_id'] == $timetable['subjects'][$count_subjects]['id']) {
                        $subject = $timetable['subjects'][$count_subjects]['brief'];
                    }
                    $count_subjects--;
                }
                addSubjectCistTimetable($auditory_count, $subject, $timetable['events'][$count_events]['number_pair'], date("d.m.y", $timetable['events'][$count_events]['start_time']));
                $count_events--;
            }
            $auditory_count--;
        }
        refreshCistTimetableUpdateTime();
        echo "OK";
        break;
    /**
     * Видалення події з розкладу
     */
    case 'delete_timetable_event':
        if (isset($_POST['auditory']) && isset($_POST['date']) && isset($_POST['period'])) {
            $del_auditory = filter_input(INPUT_POST, 'auditory');
            $del_date = filter_input(INPUT_POST, 'date');
            $del_period = filter_input(INPUT_POST, 'period');
            mysqli_query($connection, 'DELETE FROM timetable WHERE auditory_id =' . $del_auditory . '  AND date = "' . $del_date . '" AND period_number = "' . $del_period . '"');
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Редагування нотатків(Суперадміністратор)
     */
    case 'edit_notes':
        if (isset($_POST['notes'])) {
            $notes = htmlspecialchars(filter_input(INPUT_POST, 'notes'));
            mysqli_query($connection, "UPDATE configuration SET notes = '$notes' WHERE id = 1", MYSQLI_ASSOC);
        }
        break;
    /**
     * Додавання події
     */
    case 'add_event':
        if (isset($_POST['event_name']) && isset($_POST['description']) && isset($_POST['type']) && isset($_POST['price'])) {
            $event_name = filter_input(INPUT_POST, 'event_name');
            $description = htmlspecialchars(filter_input(INPUT_POST, 'description'));
            $type = filter_input(INPUT_POST, 'type');
            $price = filter_input(INPUT_POST, 'price');
            $owner_id = filter_input(INPUT_POST, 'owner_id');
            $status = filter_input(INPUT_POST, 'status');
            mysqli_query($connection, "INSERT INTO events (event_name, description, type, price, owner_id, status) VALUES ('$event_name','$description','$type','$price','$owner_id','$status')");
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Модерація подій
     */
    case 'accept_event':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "UPDATE events SET status = 'moderated' WHERE id = '$id'", MYSQLI_ASSOC);
            $event_name = getEventNameById($id);
            $description = getEventDescriptionById($id);
            $owner_id = getEventOwnerId($id);
            $telephone = getTeacherPhoneById($owner_id);
            $chat_id = TelegramGetChatId($telephone);
            TelegramSendMessage('Вітаємо! Вашу подію "' . $event_name . '" промодеровано та активовано.', $chat_id);
            wp_post(1, $description, $event_name, $event_name);
            TelegramPostToAllChannelsAndGroups('Нова подія "' . $event_name . '". ' . $description);
        }
        break;
    case 'cancel_event':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "UPDATE events SET status = 'canceled' WHERE id = '$id'", MYSQLI_ASSOC);
            $event_name = getEventNameById($id);
            $owner_id = getEventOwnerId($id);
            $telephone = getTeacherPhoneById($owner_id);
            $chat_id = TelegramGetChatId($telephone);
            TelegramSendMessage('На жаль вашу подію "' . $event_name . '" відхилено', $chat_id);
        }
        break;

    /**
     * Автентифікація користувача (студента) в системі
     */
    case 'student_auth':
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = md5($_POST['password']);
            $res = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM students WHERE login='$login'"));

            if ($login == $res['login'] && $password == $res['password']) {
                session_start();
                $_SESSION = array(
                    'uid' => $res['id'],
                    'username' => $res['login'],
                    'full_name' => $res['full_name'],
                    'status' => 'student'
                );
                echo "OK";
            } else {
                echo "ERROR";
            }
        }
        break;
    /**
     * Автентифікація користувача (Викладача/ІТ-професіонала) в системі
     */
    case 'teacher_auth':
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = md5($_POST['password']);
            $res = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM teachers WHERE login='$login' AND password = '$password'"));

            if ($login == $res['login'] && $password == $res['password']) {
                session_start();
                $_SESSION = array(
                    't_uid' => $res['id'],
                    't_username' => $res['login'],
                    't_full_name' => $res['full_name'],
                    't_status' => $res['status']
                );
                echo "OK";
            } else {
                echo "ERROR";
            }
        }
        break;
    /**
     * Отримання імені співрозмовника в чаті
     */
    case 'get_companion_name':
        if (isset($_POST['current_chat'])) {
            $current_chat = explode('@', $_POST['current_chat']);
            if ($current_chat[1] == "super_administrator") {
                echo "<span class='text-danger'>Адміністратор</span>";
            } else if ($current_chat[1] == "student") {
                echo getStudentFullNameById($current_chat[0]);
            } else if ($current_chat[1] == "teacher" || $current_chat[1] == "it_professional") {
                echo getTeacherNameById($current_chat[0]);
            }
        }
        break;
    /**
     * Запис студента на подію
     */
    case 'sign_up_to_event':
        if (isset($_POST['student_id']) && isset($_POST['event_id'])) {
            $student_id = filter_input(INPUT_POST, 'student_id');
            $event_id = filter_input(INPUT_POST, 'event_id');
            $verify = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM records_to_event WHERE student_id ='$student_id' AND event_id = '$event_id'"));
            if ($verify['count'] > 0) {
                echo "RECORDED";
            } else {
                mysqli_query($connection, "INSERT INTO records_to_event (student_id, event_id, accepted) VALUES ('$student_id','$event_id',0)", MYSQLI_ASSOC);
                echo 'OK';
            }
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Модерація запису студента на подію
     */
    case 'moderate_event_record':
        if (isset($_POST['student_id']) && isset($_POST['event_id']) && isset($_POST['accepted'])) {
            $student_id = filter_input(INPUT_POST, 'student_id');
            $event_id = filter_input(INPUT_POST, 'event_id');
            $accepted = filter_input(INPUT_POST, 'accepted');
            $event_name = getEventNameById($event_id);
            $telephone = getStudentPhoneById($student_id);
            $chat_id = TelegramGetChatId($telephone);
            if ($accepted == 1) {
                TelegramSendMessage('Вітаємо! Вас прийнято на курс ' . $event_name, $chat_id);
            } else {
                TelegramSendMessage('На жаль вам відмовлено в записі на курс ' . $event_name, $chat_id);
            }
            mysqli_query($connection, "UPDATE records_to_event SET accepted = '$accepted' WHERE student_id = '$student_id' AND event_id = '$event_id'", MYSQLI_ASSOC);
            echo 'OK';
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування оцінки
     */
    case 'edit_mark':
        if (isset($_POST['student_id']) && isset($_POST['event_id']) && isset($_POST['mark']) && isset($_POST['date'])) {
            $student_id = filter_input(INPUT_POST, 'student_id');
            $event_id = filter_input(INPUT_POST, 'event_id');
            if (strtolower($_POST['mark']) == "н" || strtolower($_POST['mark']) == "h") {
                $mark = 'Н';
            } else {
                $mark = filter_input(INPUT_POST, 'mark');
            }
            $date = filter_input(INPUT_POST, 'date');
            mysqli_query($connection, "UPDATE digital_journal_marks SET mark = '$mark' WHERE student_id = '$student_id' AND event_id = '$event_id' AND date = '$date'", MYSQLI_ASSOC);
        }
        break;
    /**
     * Редагування теми заняття
     */
    case 'edit_theme':
        if (isset($_POST['event_id']) && isset($_POST['date'])) {
            $event_id = filter_input(INPUT_POST, 'event_id');
            $date = filter_input(INPUT_POST, 'date');
            $theme = filter_input(INPUT_POST, 'theme');
            mysqli_query($connection, "UPDATE digital_journal_themes SET theme = '$theme' WHERE event_id = '$event_id' AND date = '$date'", MYSQLI_ASSOC);
        }
        break;
    /**
     * Відновлення паролю (студент)
     */
    case 'restore_password':
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
            $max = 10;
            $size = StrLen($chars) - 1;
            $password = null;
            while ($max--) {
                $password .= $chars[rand(0, $size)];
            }
            $new_password = md5($password);
            $res = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM students WHERE login='$login'"));
            if (count($res) > 0) {
                $telephone = getStudentPhoneById($res['id']);
                $chat_id = TelegramGetChatId($telephone);
                mysqli_query($connection, "UPDATE students SET password = '$new_password' WHERE login = '$login'", MYSQLI_ASSOC);
                TelegramSendMessage('Ваш пароль було змінено. Ваші нові дані для входу в систему: Логін: "' . $login . '" Пароль: ' . $password, $chat_id);
                echo "OK";
            } else {
                echo "ERROR";
            }
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Відновлення паролю (викладач)
     */
    case 'teacher_restore_password':
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
            $max = 10;
            $size = StrLen($chars) - 1;
            $password = null;
            while ($max--) {
                $password .= $chars[rand(0, $size)];
            }
            $new_password = md5($password);
            $res = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM teachers WHERE login='$login'"));
            if (count($res) > 0) {
                $telephone = getTeacherPhoneById($res['id']);
                $chat_id = TelegramGetChatId($telephone);
                mysqli_query($connection, "UPDATE teachers SET password = '$new_password' WHERE login = '$login'", MYSQLI_ASSOC);
                TelegramSendMessage('Ваш пароль було змінено. Ваші нові дані для входу в систему: Логін: "' . $login . '" Пароль: ' . $password, $chat_id);
                echo "OK";
            } else {
                echo "ERROR";
            }
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Модерація Telegram каналів/груп
     */
    case 'telegram_accept':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "UPDATE telegram_groups_and_channels SET verified = 1 WHERE id = '$id'", MYSQLI_ASSOC);
            $chat_id = TelegramGetChannelOrGroupChatId($id);
            TelegramSendMessage('Вітаємо! Вашу спільноту зареєстровано в системі "' . getAppName() . '" .', $chat_id);
        }
        break;
    case 'telegram_cancel':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "UPDATE telegram_groups_and_channels SET verified = 2 WHERE id = '$id'", MYSQLI_ASSOC);
            $chat_id = TelegramGetChannelOrGroupChatId($id);
            TelegramSendMessage('На жаль вашій спільноті відмовлено в реєстрації', $chat_id);
            echo $chat_id . '-' . $id;
        }
        break;
    /**
     * Редагування студента AJAX
     */
    case 'edit_student':
        if (isset($_POST['id']) &&
            isset($_POST['full_name']) &&
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['address'])) {
            $id = filter_input(INPUT_POST, 'id');
            $full_name = filter_input(INPUT_POST, 'full_name');
            $study_place = filter_input(INPUT_POST, 'study_place');
            $working_place = filter_input(INPUT_POST, 'working_place');
            $telephone = filter_input(INPUT_POST, 'telephone');
            $email = filter_input(INPUT_POST, 'email');
            $skype = filter_input(INPUT_POST, 'skype');
            $telegram = filter_input(INPUT_POST, 'telegram');
            $address = filter_input(INPUT_POST, 'address');
            mysqli_query($connection,
                "UPDATE students SET full_name = '$full_name',study_place = '$study_place',working_place = '$working_place',telephone = '$telephone',email = '$email',skype = '$skype',telegram = '$telegram',address = '$address' WHERE id = '$id'");
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування Викладача/IT-професіонала AJAX
     */
    case 'edit_teacher':
        if (isset($_POST['id']) &&
            isset($_POST['full_name']) &&
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['address']) &&
            isset($_POST['status'])) {
            $id = filter_input(INPUT_POST, 'id');
            $full_name = filter_input(INPUT_POST, 'full_name');
            $education = filter_input(INPUT_POST, 'education');
            $job_place = filter_input(INPUT_POST, 'job_place');
            $telephone = filter_input(INPUT_POST, 'telephone');
            $email = filter_input(INPUT_POST, 'email');
            $skype = filter_input(INPUT_POST, 'skype');
            $telegram = filter_input(INPUT_POST, 'telegram');
            $address = filter_input(INPUT_POST, 'address');
            $status = filter_input(INPUT_POST, 'status');
            mysqli_query($connection,
                "UPDATE teachers SET full_name = '$full_name',education = '$education',job_place = '$job_place',telephone = '$telephone',email = '$email',skype = '$skype',telegram = '$telegram',address = '$address',status = '$status' WHERE id = '$id'");
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Видалення аудиторії
     */
    case 'delete_auditory':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "DELETE FROM auditories WHERE id = '$id'");
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Видалення студента
     */
    case 'delete_student':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "DELETE FROM students WHERE id = '$id'");
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Видалення викладача/IT-професіонала
     */
    case 'delete_teacher':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "DELETE FROM teachers WHERE id = '$id'");
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Видалення події з системи
     */
    case 'delete_event':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            mysqli_query($connection, "DELETE FROM events WHERE id = '$id'");
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування події
     */
    case 'edit_event':
        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id');
            $event_name = filter_input(INPUT_POST, 'event_name');
            $description = filter_input(INPUT_POST, 'description');
            $type = filter_input(INPUT_POST, 'type');
            $price = filter_input(INPUT_POST, 'price');
            mysqli_query($connection, "UPDATE events SET event_name = '$event_name', description = '$description',type = '$type', price = '$price' WHERE id = '$id'");
            echo 'OK';
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування профілю (суперадміністратор)
     */
    case 'edit_admin_profile':
        if (isset($_POST['login'])) {
            $login = filter_input(INPUT_POST, 'login');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $telephone = filter_input(INPUT_POST, 'telephone');
            if ($_POST['password'] != "") {
                mysqli_query($connection, "UPDATE super_administrators SET login = '$login', password = '$password', telephone = '$telephone' WHERE id = '1'");
            } else {
                mysqli_query($connection, "UPDATE super_administrators SET login = '$login', telephone = '$telephone' WHERE id = '1'");
            }
            echo 'OK';
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування профілю студента
     */
    case 'edit_student_profile':
        if (isset($_POST['id']) &&
            isset($_POST['full_name']) &&
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['address'])) {
            $id = filter_input(INPUT_POST, 'id');
            $full_name = filter_input(INPUT_POST, 'full_name');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $study_place = filter_input(INPUT_POST, 'study_place');
            $working_place = filter_input(INPUT_POST, 'working_place');
            $telephone = filter_input(INPUT_POST, 'telephone');
            $email = filter_input(INPUT_POST, 'email');
            $skype = filter_input(INPUT_POST, 'skype');
            $telegram = filter_input(INPUT_POST, 'telegram');
            $address = filter_input(INPUT_POST, 'address');
            if ($_POST['password'] == "") {
                mysqli_query($connection,
                    "UPDATE students SET full_name = '$full_name',study_place = '$study_place',working_place = '$working_place',telephone = '$telephone',email = '$email',skype = '$skype',telegram = '$telegram',address = '$address' WHERE id = '$id'");
            } else {
                mysqli_query($connection,
                    "UPDATE students SET password = '$password', full_name = '$full_name',study_place = '$study_place',working_place = '$working_place',telephone = '$telephone',email = '$email',skype = '$skype',telegram = '$telegram',address = '$address' WHERE id = '$id'");
            }
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Редагування профілю Викладача/IT-професіонала AJAX
     */
    case 'edit_teacher_profile':
        if (isset($_POST['id']) &&
            isset($_POST['full_name']) &&
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['address'])) {
            $id = filter_input(INPUT_POST, 'id');
            $full_name = filter_input(INPUT_POST, 'full_name');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $education = filter_input(INPUT_POST, 'education');
            $job_place = filter_input(INPUT_POST, 'job_place');
            $telephone = filter_input(INPUT_POST, 'telephone');
            $email = filter_input(INPUT_POST, 'email');
            $skype = filter_input(INPUT_POST, 'skype');
            $telegram = filter_input(INPUT_POST, 'telegram');
            $address = filter_input(INPUT_POST, 'address');
            if ($_POST['password'] == "") {
                mysqli_query($connection,
                    "UPDATE teachers SET full_name = '$full_name',education = '$education',job_place = '$job_place',telephone = '$telephone',email = '$email',skype = '$skype',telegram = '$telegram',address = '$address' WHERE id = '$id'");
            } else {
                mysqli_query($connection,
                    "UPDATE teachers SET  full_name = '$full_name', password = '$password',education = '$education',job_place = '$job_place',telephone = '$telephone',email = '$email',skype = '$skype',telegram = '$telegram',address = '$address' WHERE id = '$id'");

            }
            echo "OK";
        } else {
            echo 'ERROR';
        }
        break;
    /**
     * Створення електронного журналу для події
     */
    case 'create_digital_journal':
        if (isset($_POST['id']) && isset($_POST['date'])&& isset($_POST['period_number'])) {
            $event_id = filter_input(INPUT_POST, 'id');
            $post_date = filter_input(INPUT_POST, 'date');
            $period_number = filter_input(INPUT_POST,'period_number');
            $teacher_id = filter_input(INPUT_POST,'teacher_id');
            $auditory_id = filter_input(INPUT_POST,'auditory_id');
            $date = date("d.m.y", strtotime($post_date));
            $theme = filter_input(INPUT_POST, 'theme');
            addThemeToDigitalJournal($event_id, $date, $theme);
            $event_group = getEventGroupJSON($event_id);
            $result = json_decode($event_group, 'true');
            addTeacherEventToTimetable($auditory_id, $event_id, $period_number, $date, $teacher_id);
            $count = count($result) - 1;
            while ($count >= 0) {
                addDateToDigitalJournal($event_id, $result[$count]['student_id'], $date);
                $count--;
            }
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Редагування конфігурації WordPress блогу
     */
    case 'edit_wp_config':
        if (isset($_POST['wp_db_host']) && isset($_POST['wp_db_user']) && isset($_POST['wp_db_password']) && $_POST['wp_db_name']) {
            $wp_url = filter_input(INPUT_POST, 'wp_url');
            $wp_db_host = filter_input(INPUT_POST, 'wp_db_host');
            $wp_db_user = filter_input(INPUT_POST, 'wp_db_user');
            $wp_db_password = filter_input(INPUT_POST, 'wp_db_password');
            $wp_db_name = filter_input(INPUT_POST, 'wp_db_name');
            mysqli_query($connection, "UPDATE configuration SET wp_url = '$wp_url', wp_db_host = '$wp_db_host', wp_db_user = '$wp_db_user', wp_db_password = '$wp_db_password', wp_db_name = '$wp_db_name' WHERE id = 1", MYSQLI_ASSOC);
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Видалення заняття з електронного журналу
     */
    case 'delete_digital_journal':
        if (isset($_POST['id']) && isset($_POST['date'])) {
            $event_id = filter_input(INPUT_POST, 'id');
            $date = filter_input(INPUT_POST, 'date');
            mysqli_multi_query($connection, "DELETE FROM digital_journal_themes WHERE date = '$date' AND event_id = '$event_id'; DELETE FROM digital_journal_marks WHERE date = '$date' AND event_id = '$event_id';");
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Перевірка реєстрації телефону
     */
    case 'telegram_verify_number':
        if (isset($_POST['phone'])) {
            $phone = filter_input(INPUT_POST, 'phone');
            $reg = TelegramIsPhoneRegistered($phone);
            if ($reg > 0) {
                echo "OK";
            } else {
                echo "ERROR";
            }
        }
        break;
    /**
     * Перевірка на наявність логіну студента в системі
     */
    case 'student_login_verify':
        if (isset($_POST['login'])) {
            $login = filter_input(INPUT_POST, 'login');
            $reg = isStudentRegistered($login);
            if ($reg <= 0) {
                echo "OK";
            } else {
                echo "ERROR";
            }
        }
        break;
    /**
     * Отримання списку кафедр
     */
    case 'get_departments':
        if (isset($_POST['faculty_id'])) {
            $faculty_id = filter_input(INPUT_POST, 'faculty_id');
            $departments = getNureDepartments($faculty_id);
            $departments_count = count($departments['faculty']['departments']) - 1;
            while ($departments_count >= 0) { ?>
                <option
                        value="<?php echo $departments['faculty']['departments'][$departments_count]['id'] ?>"><?php echo $departments['faculty']['departments'][$departments_count]['full_name'] ?></option>
                <?php
                $departments_count--;
            }
        }
        break;
    /**
     * Отримання списку викладачів
     */
    case 'get_teachers':
        if (isset($_POST['department_id'])) {
            $department_id = filter_input(INPUT_POST, 'department_id');
            $teachers = getNureTeachers($department_id);
            $teachers_count = count($teachers['department']['teachers']) - 1;
            while ($teachers_count >= 0) { ?>
                <option value="<?php echo $teachers['department']['teachers'][$teachers_count]['id'] ?>"><?php echo $teachers['department']['teachers'][$teachers_count]['full_name'] ?></option>
                <?php
                $teachers_count--;
            }
        }
        break;
    /**
     * Синхронізація розкладу викладача з CIST
     */
    case 'synchronize_cist':
        if (isset($_POST['teacher_id']) && isset($_POST['t_uid'])) {
            $teacher_id = filter_input(INPUT_POST, 'teacher_id');
            $t_uid = filter_input(INPUT_POST, 't_uid');
            mysqli_query($connection, "UPDATE teachers SET cist_id = '$teacher_id' WHERE id = '$t_uid'");
            $telephone = getTeacherPhoneById($t_uid);
            $chat_id = TelegramGetChatId($telephone);
            TelegramSendMessage('Розклад з CIST успішно синхронізовано.', $chat_id);
            echo "OK";
        } else {
            echo "ERROR";
        }
        break;
    /**
     * Перевірка розкладу CIST
     */
    case 'verify_cist_timetable':
        if (isset($_POST['verify_date']) && isset($_POST['verify_pair']) && isset($_POST['teacher_id'])) {
            $verify_date = filter_input(INPUT_POST, 'verify_date');
            $verify_pair = filter_input(INPUT_POST, 'verify_pair');
            $verify_teacher = filter_input(INPUT_POST, 'teacher_id');

            $timetable_json = getTeacherCistTimetable($verify_teacher);

            $events_count = count($timetable_json['events']) - 1;
            $types_count = count($timetable_json['types']) - 1;
            $subjects_count = count($timetable_json['subjects']) - 1;
            $subjects = [];
            $types = [];
            while ($subjects_count >= 0) {
                $subj_id = $timetable_json['subjects'][$subjects_count]['id'];
                $subjects[$subj_id] = $timetable_json['subjects'][$subjects_count]['title'];
                $subjects_count--;
            }
            while ($types_count >= 0) {
                $type_id = $timetable_json['types'][$types_count]['id'];
                $types[$type_id] = $timetable_json['types'][$types_count]['full_name'];
                $types_count--;
            }
            while ($events_count >= 0) {

                $date = date("d.m.y", $timetable_json['events'][$events_count]['start_time']);
                $subject_id = $timetable_json['events'][$events_count]['subject_id'];
                $pair_number = $timetable_json['events'][$events_count]['number_pair'];
                $auditory = $timetable_json['events'][$events_count]['auditory'];
                $type = $timetable_json['events'][$events_count]['type'];
                if ($date == $verify_date && $pair_number == $verify_pair) {
                    $result = "В цей час у вас проходить заняття \"" . $subjects[$subject_id] . "\" ($types[$type]) в аудиторії $auditory";
                break;
                }else{
                    $result = "OK";
                }
                $events_count--;
            }
            echo $result;
        }
        break;
}
