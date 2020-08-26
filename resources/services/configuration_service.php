<?php

function getAppName()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT app_name FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["app_name"];
}

function refreshCistTimetableUpdateTime()
{
    global $connection;
    $datetime = date("d.m.Y H:i:s");
    mysqli_query($connection, "UPDATE configuration SET cist_timetable_update_time = '$datetime' WHERE id = 1");
}

function getCistTimetableUpdateTime()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT cist_timetable_update_time FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["cist_timetable_update_time"];
}

function getNotes()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT notes FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["notes"];
}

function getTelegramBotAPIKey()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT tg_bot_api_key FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["tg_bot_api_key"];
}

function getWPDbHost()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT wp_db_host FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["wp_db_host"];
}

function getWPDbUser()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT wp_db_user FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["wp_db_user"];
}

function getWPDbPassword()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT wp_db_password FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["wp_db_password"];
}

function getWPDbName()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT wp_db_name FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["wp_db_name"];
}
function getWPURL()
{
    global $connection;
    $configuration_array = mysqli_fetch_array(mysqli_query($connection, "SELECT wp_url FROM configuration WHERE id =1", MYSQLI_ASSOC));
    return $configuration_array["wp_url"];
}