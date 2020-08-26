<?php

function getTimetableByDate($auditory_id, $date)
{
    global $connection;
    $result = [];
    $timetable = mysqli_query($connection, 'SELECT * FROM timetable WHERE auditory_id =' . $auditory_id . ' AND date ="' . $date . '"', MYSQLI_ASSOC);
    while ($row = mysqli_fetch_array($timetable)) {
        array_push($result, $row);
    }
    return json_encode($result);
}

function getSubjectByAuditoryDatePeriod($auditory_id, $date, $period_nuber)
{
    global $connection;
    $event = mysqli_fetch_array(mysqli_query($connection, 'SELECT * FROM timetable WHERE auditory_id =' . $auditory_id . ' AND date ="' . $date . '" AND period_number =' . $period_nuber, MYSQLI_ASSOC));
    $result = mysqli_fetch_array(mysqli_query($connection, 'SELECT event_name FROM events WHERE id ="' . $event['event_id'] . '"', MYSQLI_ASSOC));
    return $result['event_name'];
}

function addEventToTimetable($auditory_id, $event_id, $period_number, $date)
{
    global $connection;
    mysqli_query($connection, "INSERT INTO timetable (auditory_id, event_id, period_number, date) VALUES ('$auditory_id','$event_id','$period_number','$date')");
    return true;
}
function addTeacherEventToTimetable($auditory_id, $event_id, $period_number, $date, $teacher_id)
{
    global $connection;
    mysqli_query($connection, "INSERT INTO timetable (auditory_id, event_id, period_number, teacher_id,date) VALUES ('$auditory_id','$event_id','$period_number','$teacher_id','$date')");
    return true;
}

function getTeacherTimetable($teacher_id)
{
    global $connection;
    $result = [];
    $timetable = mysqli_query($connection, "SELECT events.event_name, auditories.name AS auditory, timetable.date, timetable.period_number FROM timetable,auditories,events WHERE timetable.teacher_id = '$teacher_id' AND timetable.auditory_id = auditories.id AND timetable.event_id = events.id");
    while ($row = mysqli_fetch_array($timetable)) {
        array_push($result, $row);
    }
    return json_encode($result);
}

function getTeacherTimetableDates($teacher_id)
{
    global $connection;
    $result = [];
    $timetable = mysqli_query($connection, "SELECT DISTINCT timetable.date FROM timetable WHERE timetable.teacher_id = '$teacher_id'");
    while ($row = mysqli_fetch_array($timetable)) {
        array_push($result, $row);
    }
    return json_encode($result);
}

function getShortCistTeacherTimetable($teacher_cist_id)
{
    $timetable_json = getTeacherCistTimetable($teacher_cist_id);

    $events_count = count($timetable_json['events']) - 1;
    $types_count = count($timetable_json['types']) - 1;
    $subjects_count = count($timetable_json['subjects']) - 1;
    $subjects = [];
    $types = [];
    $result = [];
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
        $row = array(
            'auditory' => $auditory,
            'pair_number' => $pair_number,
            'subject' => $subjects[$subject_id],
            'date' => $date
        );
        array_push($result, $row);
        //  $result = "В цей час у вас проходить заняття \"" . $subjects[$subject_id] . "\" ($types[$type]) в аудиторії $auditory";
        $events_count--;
    }
    return json_encode($result);
}

function getStudentTimetable($student_id)
{
    global $connection;
    $result = [];
    $timetable = mysqli_query($connection, "SELECT events.event_name, auditories.name AS auditory, timetable.date, timetable.period_number FROM records_to_event,timetable,auditories,events WHERE records_to_event.student_id = '$student_id' AND records_to_event.accepted = 1 AND timetable.auditory_id = auditories.id AND timetable.event_id = events.id AND records_to_event.event_id = timetable.event_id;");
    while ($row = mysqli_fetch_array($timetable)) {
        array_push($result, $row);
    }
    return json_encode($result);
}

function getStudentTimetableDates($student_id)
{
    global $connection;
    $result = [];
    $timetable = mysqli_query($connection, "SELECT DISTINCT timetable.date FROM records_to_event,timetable,auditories,events WHERE records_to_event.student_id = '$student_id' AND records_to_event.accepted = 1 AND records_to_event.event_id = timetable.event_id;");
    while ($row = mysqli_fetch_array($timetable)) {
        array_push($result, $row);
    }
    return json_encode($result);
}