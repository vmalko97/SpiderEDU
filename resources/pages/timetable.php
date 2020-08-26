<?php
$p_count = getPeriodsCount();
$timetable_dates = json_decode(getStudentTimetableDates($_SESSION['uid']), true);
$timetable = json_decode(getStudentTimetable($_SESSION['uid']), true);
?>
<table class="table table-bordered">
    <tr class="bg-grey-800">
        <td>Дата/час</td>
        <?php
        for ($i = 0; $i < count($timetable_dates); $i++) {
            ?>
            <td><?php echo $timetable_dates[$i]['date'] ?></td>
        <?php } ?>
    </tr>
    <?php for ($count = 1; $count < $p_count; $count++) { ?>
        <tr>
            <td class="bg-slate"><?php echo getPeriodTimeRange($count); ?></td>
            <?php for ($j = 0; $j < count($timetable_dates); $j++) {
                ?>
                <td class="bg-grey" identifier="<?php echo $timetable[$j]['date'].'|'.$count; ?>"></td>
                <?php
            }
            ?>
        </tr>
        <?php
    } ?>
</table>

<script type="text/javascript">
    <?php for ($l = 0; $l < count($timetable); $l++) {
    ?>
    $("td[identifier='<?php echo $timetable[$l]['date'].'|'.$timetable[$l]['period_number'];?>']").html("<?php  echo $timetable[$l]['event_name'] . "<div class='label label-success pull-right'>" . $timetable[$l]['auditory'] . "</div>";
        ?>").attr("class","bg-violet-400");
    <?php

    }
    ?>
</script>