<?php
function getEventGroup($event_id)
{
    global $connection;
    $result = mysqli_query($connection, "SELECT records_to_event.student_id, students.full_name FROM records_to_event,students WHERE records_to_event.event_id = $event_id AND records_to_event.accepted = 1 AND records_to_event.student_id = students.id ORDER BY students.full_name ASC", MYSQLI_ASSOC);
    return $result;
}

function getEventGroupJSON($event_id)
{
    global $connection;
    $result = [];
    $res = mysqli_query($connection, "SELECT records_to_event.student_id, students.full_name FROM records_to_event,students WHERE records_to_event.event_id = $event_id AND records_to_event.accepted = 1 AND records_to_event.student_id = students.id ORDER BY students.full_name ASC", MYSQLI_ASSOC);
    while ($row = mysqli_fetch_array($res)) {
        array_push($result, $row);
    }
    return json_encode($result);
}

function getEventGroupWithMarks($event_id, $date){
    global $connection;
    $result = mysqli_query($connection, "SELECT records_to_event.student_id, students.full_name, digital_journal_marks.mark FROM records_to_event,students,digital_journal_marks WHERE records_to_event.event_id = '$event_id' AND records_to_event.student_id = digital_journal_marks.student_id AND records_to_event.event_id = digital_journal_marks.event_id AND records_to_event.event_id = digital_journal_marks.event_id AND digital_journal_marks.date = '$date' AND  records_to_event.accepted = 1 AND records_to_event.student_id = students.id ORDER BY students.full_name ASC", MYSQLI_ASSOC);
    return $result;
}

function getStudentMark($event_id, $student_id, $date)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT mark FROM digital_journal_marks WHERE event_id = '$event_id' AND student_id = '$student_id' AND date = '$date'",MYSQLI_ASSOC));
    return $result['mark'];
}

function getTheme($event_id, $date)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection, "SELECT theme FROM `digital_journal_themes` WHERE event_id = $event_id AND date = '$date'"));
    return $result['theme'];
}

function addDateToDigitalJournal($event_id, $student_id, $date)
{
    global $connection;
    mysqli_query($connection, "INSERT INTO digital_journal_marks (event_id, student_id, date) VALUES ('$event_id','$student_id','$date')");
}

function addThemeToDigitalJournal($event_id, $date, $theme)
{
    global $connection;
    mysqli_query($connection, "INSERT INTO digital_journal_themes (event_id, date, theme) VALUES ('$event_id','$date','$theme')");
}

function getEventDates($event_id){
    global $connection;
    $result = mysqli_query($connection, "SELECT theme,date FROM digital_journal_themes WHERE event_id = '$event_id'");
    return $result;
}

function getStudentEventDigitalJournal($student_id,$event_id){
    global $connection;
    $result = mysqli_query($connection, "SELECT digital_journal_themes.theme, digital_journal_marks.date, digital_journal_marks.mark FROM digital_journal_marks,digital_journal_themes WHERE digital_journal_marks.student_id = '$student_id' AND digital_journal_themes.event_id = digital_journal_marks.event_id AND digital_journal_themes.date = digital_journal_marks.date AND digital_journal_marks.event_id = '$event_id'");
    return $result;
}

function getDigitalJournal($event_id){
    global $connection;
    $result = mysqli_query($connection, "SELECT students.full_name, digital_journal_marks.mark, digital_journal_marks.date FROM digital_journal_marks,students WHERE digital_journal_marks.event_id = '$event_id' AND digital_journal_marks.student_id = students.id;");
    return $result;
}

function getDigitalJournalDates($event_id){
    global $connection;
    $result = mysqli_query($connection, "SELECT DISTINCT digital_journal_marks.date FROM digital_journal_marks,students WHERE digital_journal_marks.event_id = '$event_id'");
    return $result;
}
