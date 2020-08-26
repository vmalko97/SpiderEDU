<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <?php

    $auditory_id = filter_input(INPUT_GET, 'auditory');
    $date = filter_input(INPUT_GET, 'date');
    $period = filter_input(INPUT_GET, 'period');

    $event_id = filter_input(INPUT_POST, 'event_id');


    if (isset($event_id) && isset($auditory_id) && isset($date) && isset($period)) {
        addEventToTimetable($auditory_id, $event_id, $period, $date);
        echo '<div class="alert alert-success" role="alert">
  Подію успішно додано
</div>';
    }
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Додавання події
            (<?php echo $date . "&nbsp;ауд." . getAuditoryNameById($auditory_id) . "&nbsp;" . $period . "&nbsp;пара&nbsp;[" . getPeriodTimeRange($period) . "]" ?>
            )</h1>
    </div>

    <form method='post'>
        <div class='form-group'>
            <div class='form-group'>
                <label>Виберіть подію</label>
                <?php
                $result = mysqli_query($connection, 'SELECT * FROM events', MYSQLI_ASSOC);
                echo "<select id='auditory' name='event_id' class='form-control form-control-sm'>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['event_name'] . "</option>";
                }
                echo "</select>"; ?>
                <br/>
                <button class='btn btn-block btn-primary' type='submit'>Додати</button>
            </div>
    </form>
</main>
