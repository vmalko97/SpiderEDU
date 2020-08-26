<?php

function getTeachers(){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM teachers WHERE status = 'teacher' ORDER BY id DESC",MYSQLI_ASSOC);
    return $result;
}
function getITProfessionals(){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM teachers WHERE status = 'it_professional' ORDER BY id DESC",MYSQLI_ASSOC);
    return $result;
}
function getTeacherNameById($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT full_name FROM teachers WHERE id = ".$id." ORDER BY id DESC",MYSQLI_ASSOC));
    return $result['full_name'];
}
function getTeacherPhoneById($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT telephone FROM teachers WHERE id = '$id'",MYSQLI_ASSOC));
    return $result['telephone'];
}
function getTeacherDataById($id){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM teachers WHERE id = '$id'",MYSQLI_ASSOC);
    return $result;
}
function getTeachersCount(){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(*) as count FROM teachers WHERE status = 'teacher'",MYSQLI_ASSOC));
    return $result['count'];
}
function getITProfessionalCount(){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(*) AS count FROM teachers WHERE status = 'it_professional'",MYSQLI_ASSOC));
    return $result['count'];
}
function getTeacherCistId($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT cist_id FROM teachers WHERE id = '$id'",MYSQLI_ASSOC));
    return $result['cist_id'];
}