<?php

function getCistTimetableByDate($auditory_id,$date){
    global $connection;
    $result = [];
    $timetable = mysqli_query($connection,'SELECT * FROM cist_timetable WHERE auditory_id ='.$auditory_id.' AND date ="'.$date.'" ORDER BY period_number ASC', MYSQLI_ASSOC);
    while ($row = mysqli_fetch_array($timetable)){
        array_push($result,$row);
    }
    return json_encode($result);
}
function getCistSubjectByAuditoryDatePeriod($auditory_id,$date, $period_nuber)
{
    global $connection;
    $result = mysqli_fetch_array(mysqli_query($connection,'SELECT * FROM cist_timetable WHERE auditory_id ='.$auditory_id.' AND date ="'.$date.'" AND period_number ='.$period_nuber, MYSQLI_ASSOC));
    return $result['subject'];
}