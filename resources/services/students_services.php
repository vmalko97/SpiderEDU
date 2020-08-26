<?php

function getStudents(){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM students ORDER BY id DESC",MYSQLI_ASSOC);
    return $result;
}
function getStudentPhoneById($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT telephone FROM students WHERE id = '$id'",MYSQLI_ASSOC));
    return $result['telephone'];
}
function getStudentDataById($id){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM students WHERE id = '$id'",MYSQLI_ASSOC);
    return $result;
}
function getStudentsCount(){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(*) AS count FROM students ORDER BY id DESC",MYSQLI_ASSOC));
    return $result['count'];
}

function isStudentRegistered($login){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(*) AS count FROM students WHERE login = '$login'",MYSQLI_ASSOC));
    return $result['count'];
}