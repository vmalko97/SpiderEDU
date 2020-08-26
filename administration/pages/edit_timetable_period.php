<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <?php

    $edit_auditory = filter_input(INPUT_GET, 'auditory');
    $edit_date = filter_input(INPUT_GET, 'date');
    $edit_period = filter_input(INPUT_GET, 'period');
    $event_id = filter_input(INPUT_POST, 'event_id');

    $post_date = filter_input(INPUT_POST, 'date');
    $date = date("d.m.y", strtotime($post_date));

    if (isset($edit_auditory) && isset($edit_date) && isset($edit_period)) {

        if (isset($event_id) && isset($auditory) && isset($date)) {
            mysqli_query($connection, 'UPDATE timetable SET auditory_id ='.$auditory.' , date ='.$date.' , event_id = ' . $event_id . '  WHERE auditory_id =' . $edit_auditory . '  AND date = "' . $edit_date . '" AND period_number = "' . $edit_period . '"');
            echo '<div class="alert alert-danger" role="alert">
  Подію успішно відредаговано
</div>';
        }
    }
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Редагування події
            (<?php echo $edit_date . "&nbsp;ауд." . getAuditoryNameById($edit_auditory) . "&nbsp;" . $edit_period . "&nbsp;пара&nbsp;[" . getPeriodTimeRange($edit_period) . "]" ?>
            )</h1>
    </div>

    <form method='post'>
        <div class='form-group'>
            <div class='form-group'>
                <label>Виберіть подію</label>
                <?php
                $result = mysqli_query($connection, 'SELECT * FROM events', MYSQLI_ASSOC);
                echo "<select id='event' name='event_id' class='form-control form-control-sm'>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['event_name'] . "</option>";
                }
                echo "</select>";
                echo "<label>Виберіть аудиторію</label>";
                echo "<select id='auditory' name='auditory' class='form-control form-control-sm'>";
                $auditories = getAuditories();
                while ($row = mysqli_fetch_array($auditories)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                echo "</select>
<script>document.getElementById('auditory').value = '" . $edit_auditory . "';</script>
<label>Виберіть дату</label>
<input type='date' class='form-control' id='date' name='date' placeholder='Дата' required>
<script>document.getElementById('date').value = '" . date('Y-m-d', strtotime($edit_date)) . "'</script>
<br/>
<button class='btn btn-block btn-primary' type='submit'>Оновити</button>
</div>";
                ?>
            </div>
    </form>
</main>
