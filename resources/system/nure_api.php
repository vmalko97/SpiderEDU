<?php

/*
 * CIST.NURE API MODULE
 * Powered by Vladyslav Malko
 * Формат виклику:
 * {API_ROOT}/ім'я_процедури[?параметр=значення&параметр2=значення2&...]
 */
$API_ROOT = 'http://cist.nure.ua/ias/app/tt/';
function getCistNureJson($JSON_FUNCTION, $PARAMETERS = null)
{
    global $API_ROOT;
    $response = iconv('WINDOWS-1251', 'UTF-8', file_get_contents($API_ROOT . $JSON_FUNCTION . $PARAMETERS));
    return $response;
}

function getAuditoryTimetableArray($NURE_AUDITORY_ID)
{
    $timetable_array = json_decode(
        getCistNureJson(
            'P_API_EVENTS_AUDITORY_JSON',
            '?p_id_auditory=' . $NURE_AUDITORY_ID
        ),
        'TRUE'
    );
    return $timetable_array;
}

function getTeacherCistTimetable($NURE_TEACHER_ID){
    $timetable_array = json_decode(
        getCistNureJson(
            'P_API_EVENTS_TEACHER_JSON',
            '?p_id_teacher=' . $NURE_TEACHER_ID
        ),
        'TRUE'
    );
    return $timetable_array;
}

function truncateCistTimetable()
{
    global $connection;
    mysqli_query($connection, "TRUNCATE TABLE cist_timetable", MYSQLI_ASSOC);
}

function addSubjectCistTimetable($auditory_id, $subject, $period_number, $date)
{
    global $connection;
    mysqli_query($connection, "INSERT INTO cist_timetable (auditory_id,subject,period_number,date) VALUES ('$auditory_id','$subject','$period_number','$date')", MYSQLI_ASSOC);
}

function getNureAuditories()
{
    $auditories_json = getCistNureJson('P_API_AUDITORIES_JSON');
    $auditories = json_decode($auditories_json, true);
    $buildings_count = count($auditories['university']['buildings']);
    $response = array();
    while ($buildings_count >= 0) {
        $auditories_count = count($auditories['university']['buildings'][$buildings_count]['auditories']);
        while ($auditories_count >= 0) {
            $result = $auditories['university']['buildings'][$buildings_count]['auditories'][$auditories_count];
            $auditories_count--;
            if($result != null) {
                array_push($response, $result);
            }
        }
        $buildings_count--;
    }
    return $response;
}

function getNureFaculties(){
    $faculties_array = json_decode(
        getCistNureJson('P_API_FACULTIES_JSON'),
        'TRUE'
    );
    return $faculties_array;
}

function getNureDepartments($NURE_FACULTY_ID){
    $departments_array = json_decode(
        getCistNureJson('P_API_DEPARTMENTS_JSON',
            '?p_id_faculty='. $NURE_FACULTY_ID
            ),
        'TRUE'
    );
    return $departments_array;
}

function getNureTeachers($NURE_DEPARTMENT_ID){
    $teachers_array = json_decode(
        getCistNureJson('P_API_TEACHERS_JSON',
            '?p_id_department='. $NURE_DEPARTMENT_ID
            ),
        'TRUE'
    );
    return $teachers_array;
}