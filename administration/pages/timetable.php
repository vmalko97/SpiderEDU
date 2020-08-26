<script type="text/javascript">
    function event_delete(auditory, date, period) {
        var ajax_function = "delete_timetable_event";
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                auditory: auditory,
                date: date,
                period: period
            },
            success: function (data) {
                if (data == "ERROR") {
                    swal({
                        title: "Помилка",
                        text: "Подію не видалено",
                        type: "error",
                    });
                } else if (data == "OK") {
                    swal({
                        title: "Успіх",
                        text: "Подію успішно видалено",
                        type: "success",
                    });
                } else {
                    swal({
                        title: "Hacking attempt!",
                        type: "error",
                    });
                }
            }
        });
    }
</script>
<?php
$auditories = getAuditories();
$auditory_id = filter_input(INPUT_POST, 'auditory');
$post_date = filter_input(INPUT_POST, 'date');
$date = date("d.m.y", strtotime($post_date));
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Згенерувати розклад<a class="heading-elements-toggle"><i
                                class="icon-more"></i></a></h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <form method='post' action='?page=timetable'>
                    <div class='form-group'>
                        <div class='form-group'>
                            <label>Виберіть аудиторію</label>";
                            <select id='auditory' name='auditory' class='form-control form-control-sm'>
                                <?php while ($row = mysqli_fetch_array($auditories)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label>Виберіть дату</label>
                            <input type='date' class='form-control' value='<?php echo $post_date; ?>' id='date'
                                   name='date' placeholder='Дата' required>
                            <br/>
                            <button class='btn btn-block btn-primary' type='submit'>Згенерувати</button>
                        </div>
                </form>
                <?php
                if (isset($auditory_id) && isset($post_date)) {
                    $cist_timetable = json_decode(getCistTimetableByDate($auditory_id, $date), true);
                    $timetable = json_decode(getTimetableByDate($auditory_id, $date), true);
                    $impositions = [];
                    $busy_local_periods = [];
                    $busy_cist_periods = [];


                    echo "<table class='table table-bordered'>
<thead class='bg-grey-800'>
<tr>
<th width='10%'>Пара</th>
<th width='20%'>Час проведення</th>
<th width='50%'>Предмет</th>
<th width='30%'>Дії</th>
</tr>
</thead>";
                    for ($i = 0; $i <= count($cist_timetable); $i++) {
                        for ($j = 0; $j < count($timetable); $j++) {
                            if ($cist_timetable [$i]['period_number'] == $timetable[$j]['period_number']) {
                                $impositions[$cist_timetable[$i]['period_number']] = true;
                            }

                        }
                        $busy_local_periods[$timetable[$i]['period_number']] = true;
                        $busy_cist_periods[$cist_timetable [$i]['period_number']] = true;
                    }
                    for ($periods_count = 1; $periods_count <= getPeriodsCount(); $periods_count++) {
                        if ($impositions[$periods_count] === true) {
                            echo "<tr>
<td>" . $periods_count . "</td>
<td>" . getPeriodTimeRange($periods_count) . "</td>
<td class='bg-danger-400'>" . "@LOCAL:" . getSubjectByAuditoryDatePeriod($auditory_id, $date, $periods_count) . " | @CIST:" . getCistSubjectByAuditoryDatePeriod($auditory_id, $date, $periods_count) . "</td>
<td>
<button type='button' class='btn btn-warning'><span class='icon icon-pen6'></span></button>
<button type='button' onclick='event_delete(\"$auditory_id\",\"$date\",\"$periods_count\")' class='btn btn-danger'><span class='icon icon-cancel-circle2'></span></button>
</td>
</tr>";
                        } elseif ($busy_local_periods[$periods_count] === true) {
                            echo "<tr>
<td>" . $periods_count . "</td>
<td>" . getPeriodTimeRange($periods_count) . "</td>
<td class='bg-primary-400'>" . getSubjectByAuditoryDatePeriod($auditory_id, $date, $periods_count) . "</td>
<td>
<a href='?page=edit_timetable_period&auditory=" . $auditory_id . "&date=" . $date . "&period=" . $periods_count . "' class='btn btn-warning'><span class='icon icon-pen6'></span></a>
<button type='button' onclick='event_delete(\"$auditory_id\",\"$date\",\"$periods_count\")' class='btn btn-danger'><span class='icon icon-cancel-circle2'></span></button>
</td>
</tr>";
                        } elseif ($busy_cist_periods[$periods_count] === true) {
                            echo "<tr>
<td>" . $periods_count . "</td>
<td>" . getPeriodTimeRange($periods_count) . "</td>
<td class='bg-warning-400'>" . getCistSubjectByAuditoryDatePeriod($auditory_id, $date, $periods_count) . "</td>
<td><span class='btn btn-success'><strong>CIST.NURE.UA</strong></span></td>
</tr>";
                        } else {
                            echo "<tr>
<td>" . $periods_count . "</td>
<td>" . getPeriodTimeRange($periods_count) . "</td>
<td class='bg-success-400'>Свободная пара</td>
<td>
<a href='?page=add_to_timetable&auditory=" . $auditory_id . "&date=" . $date . "&period=" . $periods_count . "' class='btn btn-primary'><span class='icon icon-add'></span></a>
</tr>";
                        }
                    }
                    echo '</table>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
