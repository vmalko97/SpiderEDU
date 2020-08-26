<?php

function getEventNameById($event_id){
    global $connection;
    $event = mysqli_fetch_array(mysqli_query($connection,'SELECT event_name FROM events WHERE id ="'.$event_id.'"',MYSQLI_ASSOC));
    return $event['event_name'];
}
function getEventDescriptionById($event_id){
    global $connection;
    $event = mysqli_fetch_array(mysqli_query($connection,'SELECT description FROM events WHERE id ="'.$event_id.'"',MYSQLI_ASSOC));
    return $event['description'];
}
function getEvents(){
    global $connection;
    $result = mysqli_query($connection,'SELECT * FROM events',MYSQLI_ASSOC);
    return $result;
}
function getModeratedEvents(){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM events WHERE status = 'moderated'",MYSQLI_ASSOC);
    return $result;
}
function getTeachersEvents($owner){
    global $connection;
    $result = mysqli_query($connection,'SELECT * FROM events WHERE owner_id ='.$owner,MYSQLI_ASSOC);
    return $result;
}
function getAdministrationEvents(){
    global $connection;
    $result = mysqli_query($connection,'SELECT * FROM events WHERE owner_id = 0',MYSQLI_ASSOC);
    return $result;
}
function getUnmoderatedEventsCount(){
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(*) AS count FROM events WHERE status = 'unmoderated'",MYSQLI_ASSOC));
    return $result['count'];
}
function getUnmoderatedEvents(){
    global $connection;
    $result = mysqli_query($connection,"SELECT *, (SELECT full_name FROM teachers WHERE events.owner_id = teachers.id) AS owner FROM events WHERE status = 'unmoderated'",MYSQLI_ASSOC);
    return $result;
}
function getEventOwnerNameById($id){
    global $connection;
    if($id == 0){
        $result = "Адміністратор ситсеми";
    }else {
        $res = mysqli_fetch_array(mysqli_query($connection, "SELECT full_name FROM teachers WHERE id = '".$id."'", MYSQLI_ASSOC));
        $result = $res['full_name'];
    }
    return $result;
}
function getEventOwnerId($event_id){
    global $connection;
    $event = mysqli_fetch_array(mysqli_query($connection,'SELECT owner_id FROM events WHERE id ="'.$event_id.'"',MYSQLI_ASSOC));
    return $event['owner_id'];
}

function getEventNewRecords($id){
    global $connection;
    $result = mysqli_query($connection,"SELECT records_to_event.student_id, students.full_name FROM records_to_event,students WHERE records_to_event.event_id = '".$id."' AND records_to_event.student_id = students.id AND records_to_event.accepted = 0",MYSQLI_ASSOC);
    return $result;
}
function getEventDataById($id){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM events WHERE id = '$id'",MYSQLI_ASSOC);
    return $result;
}
function getEventTimetableDatesById($id){
    global $connection;
    $result = mysqli_query($connection,"SELECT DISTINCT date FROM `digital_journal_marks` WHERE event_id = '$id'",MYSQLI_ASSOC);
    return $result;
}

function getStudentAcceptedEvents($student_id){
    global $connection;
    $result = mysqli_query($connection,"SELECT records_to_event.event_id, events.event_name FROM `records_to_event`,events WHERE records_to_event.student_id = '$student_id' AND records_to_event.accepted = 1 AND records_to_event.event_id = events.id",MYSQLI_ASSOC);
    return $result;
}

function getEventsForStudent($student_id){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM events WHERE status = 'moderated'",MYSQLI_ASSOC);
    return $result;
}

function getStudentEventRecords($student_id){
    global $connection;
    $result = mysqli_query($connection,"SELECT records_to_event.event_id FROM records_to_event WHERE records_to_event.student_id = '$student_id'",MYSQLI_ASSOC);
    return $result;
}