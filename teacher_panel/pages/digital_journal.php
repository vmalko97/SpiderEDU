<?php
$event_id = filter_input(INPUT_GET,'event_id');
?>
<div style="overflow: auto;">
    <table class="journal">
        <tr>
            <td class="bg-grey-800" align="center">
                ПІБ
            </td>
            <?php
            $query = getDigitalJournalDates($event_id);
            while ($digital_journal = mysqli_fetch_array($query)) {
                ?>
                <td class="rotate bg-grey-800">
                    <div><span><?php echo $digital_journal['date']; ?></span></div>
                </td>
            <?php } ?>
        </tr>
        <?php
        $event_group = getEventGroupJSON($event_id);
        $result = json_decode($event_group, 'true');
        $count = count($result) - 1;
        while ($count >= 0) {
            ?>
            <tr>
                <td><?php echo $result[$count]['full_name']; ?></td>
                <?php
                $dj_q = getStudentEventDigitalJournal($result[$count]['student_id'],$event_id);
                while ($dj = mysqli_fetch_array($dj_q)){?>
                    <td align="center"><a href="?page=marks&event_id=<?php echo $event_id; ?>&date=<?php echo $dj['date']; ?>"><b><?php echo $dj['mark']; ?></b></a></td>
                <?php } ?>
            </tr>
            <?php
            $count--;
        }
        ?>
    </table>
</div>