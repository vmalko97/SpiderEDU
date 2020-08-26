<?php

$TG_API_ROOT = "https://api.telegram.org/bot";
$TG_BOT_API_KEY = getTelegramBotAPIKey();

function TelegramSendMessage($message, $chat_id)
{
    global $TG_API_ROOT;
    global $TG_BOT_API_KEY;
    file_get_contents($TG_API_ROOT . $TG_BOT_API_KEY . '/sendMessage?chat_id=' . $chat_id . '&text=' . $message);
}

function TelegramIsPhoneRegistered($phone)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM telegram_bot_chats WHERE phone = '$phone'", MYSQLI_ASSOC));
    return $result['count'];
}

function TelegramIsChatRegistered($chat_id)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM telegram_bot_chats WHERE tg_chat_id = '$chat_id'", MYSQLI_ASSOC));
    return $result['count'];
}

function TelegramGetChatId($phone)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT tg_chat_id FROM telegram_bot_chats WHERE phone = '$phone'", MYSQLI_ASSOC));
    return $result['tg_chat_id'];
}

function TelegramAddGroupOrChannel($title, $chat_id, $type)
{
    global $connection;
    mysqli_query($connection, "INSERT INTO telegram_groups_and_channels (title, chat_id, type, verified) VALUES ('$title','$chat_id','$type',0)", MYSQLI_ASSOC);
}

function TelegramIsGroupOrChannelRegistered($chat_id)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM telegram_groups_and_channels WHERE chat_id = '$chat_id'", MYSQLI_ASSOC));
    return $result['count'];
}

function TelegramGetAllChannelsAndGroups()
{
    global $connection;
    $result = mysqli_query($connection, "SELECT chat_id FROM telegram_groups_and_channels", MYSQLI_ASSOC);
    return $result;
}

function TelegramGetAllModeratedChannelsAndGroups()
{
    global $connection;
    $result = mysqli_query($connection, "SELECT chat_id FROM telegram_groups_and_channels WHERE verified = 1", MYSQLI_ASSOC);
    return $result;
}

function TelegramPostToAllChannelsAndGroups($message)
{
    $chat_query = TelegramGetAllModeratedChannelsAndGroups();
    while ($chat = mysqli_fetch_array($chat_query)) {
        TelegramSendMessage($message, $chat['chat_id']);
    }
}

function TelegramIsGroupOrGroupRegistered($chat_id)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM telegram_groups_and_channels WHERE chat_id = '$chat_id'", MYSQLI_ASSOC));
    return $result['count'];
}

function TelegramGetUnmoderatedGroupAndChannels()
{
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM telegram_groups_and_channels WHERE verified = 0", MYSQLI_ASSOC);
    return $result;
}

function TelegramGetChannelOrGroupChatId($id)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT chat_id FROM telegram_groups_and_channels WHERE id = $id", MYSQLI_ASSOC));
    return $result['chat_id'];
}

function TelegramGetListAllGroupsAndChannels()
{
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM telegram_groups_and_channels ORDER BY id ASC", MYSQLI_ASSOC);
    return $result;
}

