<?php

function getNewMessagesCount($to)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM messages WHERE user_to = '" . $to . "' AND status = 1", MYSQLI_ASSOC));
    return $result['count'];
}

function getAllChats($to)
{
    global $connection;
    $result = mysqli_query($connection, "SELECT DISTINCT messages.user_from,messages.user_to,teachers.full_name,teachers.status FROM messages,teachers WHERE (messages.user_to = '" . $to . "' AND teachers.id = messages.user_from)", MYSQLI_ASSOC);
    return $result;
}
function getStudentFullNameById($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,'SELECT full_name FROM students WHERE id ="'.$id.'"',MYSQLI_ASSOC));
    return $result['full_name'];
}
