<li class="media">
    <div class="media-left">
        <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-bell2"></i></a>
    </div>

    <div class="media-body">
        {CONTENT}
        <div class="media-annotation">{TIME}</div>
    </div>
</li>
<?php
/**
 * Накладення пар CIST на локальний розклад
 */
$current_date = date('d.m.y');
$query = mysqli_query($connection,"SELECT DISTINCT timetable.period_number, timetable.date,events.owner_id FROM timetable,cist_timetable,events WHERE timetable.date >= '$current_date' AND cist_timetable.date = timetable.date AND timetable.auditory_id = cist_timetable.auditory_id AND timetable.period_number = cist_timetable.period_number AND events.id = timetable.event_id;");

/**
 * Накладення локального розкладу викладача на його розклад CIST
 */
$id = 86; //Білоус Н.В.
$teacher_timetable = getTeacherCistTimetable($id);
