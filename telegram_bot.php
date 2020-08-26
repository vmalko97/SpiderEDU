<?php

require_once 'resources/system/db_config.php';
require_once 'resources/system/nure_api.php';
require_once 'resources/system/system_functions.php';

//Сервіси
require_once 'resources/services/configuration_service.php';
require_once 'resources/services/periods_service.php';
require_once 'resources/services/auditories_service.php';
require_once 'resources/services/timetable_service.php';
require_once 'resources/services/cist_timetable_service.php';
require_once 'resources/services/events_service.php';
require_once 'resources/services/teachers_and_it_professionals_services.php';
require_once 'resources/services/students_services.php';
require_once 'resources/services/telegram_bot_service.php';
require_once 'resources/services/messages_service.php';
require_once 'resources/services/digital_journal_service.php';


$json = file_get_contents("php://input");
$result = json_decode($json, true);
$admin_phone = getSuperAdminPhone();
$admin_chat_id = TelegramGetChatId($admin_phone);
$tg_chat_id = $result['message']['chat']['id'];
$phone = $result['message']['contact']['phone_number'];
$message_start = substr($result['message']['text'], 0, 6);
$message_phone = substr($result['message']['text'], 6, 12);
$message_text = $result['message']['text'];
$chat_title = $result['message']['chat']['title'];
$chat_type = $result['message']['chat']['type'];
$channel_message = $result['channel_post']['text'];
$channel_title = $result['channel_post']['chat']['title'];
$channel_chat_id = $result['channel_post']['chat']['id'];
$channel_type = $result['channel_post']['chat']['type'];
if (isset($tg_chat_id) && isset($phone) && TelegramIsPhoneRegistered($phone) <= 0 && TelegramIsChatRegistered($tg_chat_id) <= 0) {
    mysqli_query($connection, "INSERT INTO telegram_bot_chats (tg_chat_id, phone) VALUES ('$tg_chat_id','$phone')", MYSQLI_ASSOC);
    TelegramSendMessage("Ви успішно зареєструвались в системі " . getAppName(), $tg_chat_id);
} else if (isset($tg_chat_id) && $message_start == "PHONE+" && TelegramIsPhoneRegistered($message_phone) <= 0 && TelegramIsChatRegistered($tg_chat_id) <= 0) {
    mysqli_query($connection, "INSERT INTO telegram_bot_chats (tg_chat_id, phone) VALUES ('$tg_chat_id','$message_phone')", MYSQLI_ASSOC);
    TelegramSendMessage("Ви успішно зареєструвались в системі " . getAppName(), $tg_chat_id);
} else if (isset($tg_chat_id) && isset($phone) && TelegramIsPhoneRegistered($phone) > 0 && TelegramIsChatRegistered($tg_chat_id) > 0) {
    TelegramSendMessage("Ви вже зареєстовані в системі", $tg_chat_id);
} else if (isset($tg_chat_id) && $message_text == "/reg_chat" && TelegramIsGroupOrChannelRegistered($tg_chat_id) <= 0) {
    TelegramSendMessage('Чат "' . $chat_title . '" буде зареєстровано в системі ' . getAppName() . ' найближчим часом', $tg_chat_id);
    TelegramAddGroupOrChannel($chat_title,$tg_chat_id,$chat_type);
    TelegramSendMessage('Реєстрація чату "' . $chat_title . '" в системі. Будь-ласка підвердіть або відхиліть автопостинг в панелі управління.', $admin_chat_id);
} else if(isset($tg_chat_id) && $message_text == "/reg_chat" && TelegramIsGroupOrChannelRegistered($tg_chat_id) > 0){
    TelegramSendMessage('Заявку на реєстрацію вже було подано або чат вже зареєстрований в системі', $tg_chat_id);
} else if (isset($channel_chat_id) && $channel_message == "/reg_channel" && TelegramIsGroupOrChannelRegistered($channel_chat_id) <= 0) {
    TelegramSendMessage('Канал "' . $channel_title . '" буде зареєстровано в системі ' . getAppName() . ' найближчим часом', $channel_chat_id);
    TelegramAddGroupOrChannel($channel_title,$channel_chat_id,$channel_type);
    TelegramSendMessage('Реєстрація каналу "' . $channel_title . '" в системі. Будь-ласка підвердіть або відхиліть автопостинг в панелі управління.', $admin_chat_id);
} else if (isset($channel_chat_id) && $channel_message == "/reg_channel" && TelegramIsGroupOrChannelRegistered($channel_chat_id) > 0) {
    TelegramSendMessage('Заявку на реєстрацію вже було подано або канал вже зареєстрований в системі', $channel_chat_id);
} else if(isset($tg_chat_id)) {
    TelegramSendMessage('Команду не знайдено', $tg_chat_id);
}
