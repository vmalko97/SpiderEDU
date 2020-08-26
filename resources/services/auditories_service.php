<?php
function getAuditoryIdByName($name){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT id FROM auditories WHERE name = ".$name, MYSQLI_ASSOC));
    return $result["id"];
}
function getAuditoryIdByCistId($cist_id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT id FROM auditories WHERE cist_id = ".$cist_id, MYSQLI_ASSOC));
    return $result["id"];
}
function getAuditoryCistIdByName($name){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT cist_id FROM auditories WHERE name = ".$name, MYSQLI_ASSOC));
    return $result["cist_id"];
}
function getAuditoryCistIdById($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT cist_id FROM auditories WHERE id = ".$id, MYSQLI_ASSOC));
    return $result["cist_id"];
}
function getAuditoryNameById($id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT name FROM auditories WHERE id = ".$id, MYSQLI_ASSOC));
    return $result["name"];
}
function getAuditoryNameByCistId($cist_id){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT name FROM auditories WHERE cist_id = ".$cist_id, MYSQLI_ASSOC));
    return $result["name"];
}
function getAuditoriesCount(){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS aud_count FROM auditories", MYSQLI_ASSOC));
    return $result["aud_count"];
}
function getAuditories(){
    global $connection;
    $result = mysqli_query($connection,'SELECT * FROM auditories',MYSQLI_ASSOC);
    return $result;
}