<?php

if (isset($_GET['event_id']) && isset($_GET['date'])) {
    $event_id = htmlspecialchars($_GET['event_id']);
    $date = filter_input(INPUT_GET, 'date');
    $event_group = getEventGroupWithMarks($_GET['event_id'], $date);
    $num = 1;
    ?>
    <script type="text/javascript">
        function edit_mark(student_id) {
            var ajax_function = "edit_mark";
            var event_id = '<?php echo $event_id;?>';
            var mark = $('#mark_' + student_id).val();
            var date = '<?php echo $date;?>';
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    student_id: student_id,
                    event_id: event_id,
                    mark: mark,
                    date: date
                }
            });
        }

        function edit_theme() {
            var ajax_function = "edit_theme";
            var event_id = '<?php echo $event_id;?>';
            var theme = $('#theme').val();
            var date = '<?php echo $date;?>';
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    event_id: event_id,
                    theme: theme,
                    date: date
                }
            });
        }
    </script>
    <?php
    echo "<div class='row'>
<div class='col-md-6'>";
    echo "<table class='table table-bordered'>
<thead class='bg-grey-800'>
<th width='10%'>№</th>
<th width='50%'>ПІБ Студента</th>
<th width='20%'>Оцінка</th>
</thead>";
    while ($student = mysqli_fetch_array($event_group)) {
        echo "
<tr>      
  <td>" . $num . "</td>
  <td><a href='?page=student_info&id=".$student['student_id']."'>" . $student['full_name'] . "</a>
  </td>
  <td><input class='form-control' type='text' id='mark_" . $student['student_id'] . "' onchange='edit_mark(" . $student['student_id'] . ")' value='" . $student['mark'] . "'/></td>
</tr>
        ";
        $num++;
    }
    echo "</table>
</div>
<div class='col-md-6'>
<table class='table table-bordered'>
<thead class='bg-grey-800'>
<tr>
<th align='center'>Тема заняття</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<textarea maxlength='200' rows='5' style='width: 100%' onkeyup='edit_theme()' id='theme'>" . getTheme($event_id, $date) . "</textarea>
</td>
</tr>
</tbody>
</table>
</div>
</div>";
}