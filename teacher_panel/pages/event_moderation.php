<?php
$event_id = filter_input(INPUT_GET, 'id');
?>
    <script type="text/javascript">
        function moderate(event_id, student_id, accepted) {
            var ajax_function = "moderate_event_record";
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    student_id: student_id,
                    event_id: event_id,
                    accepted: accepted
                },
                success: function (data) {
                    alert(data);
                    if (data == "ERROR") {
                        swal({
                            title: "Помилка",
                            text: "Спробуйте ще раз",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Студента промодеровано",
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
$query = getEventNewRecords($event_id);
echo "<table class='table table-bordered'>
<thead class='bg-grey-800'>
<th width='20%'>ID Студента</th>
<th width='50%'>ПІБ Студента</th>
<th width='30%'>Дії</th>
</thead>
";
while ($student = mysqli_fetch_array($query)) {
    echo "<tr>
<td>" . $student['student_id'] . "</td>
<td>" . $student['full_name'] . "</td>
<td>
<button class='btn btn-success' onclick='moderate(" . $event_id . "," . $student['student_id'] . ",1)'>Прийняти</button>
<button class='btn btn-danger' onclick='moderate(" . $event_id . "," . $student['student_id'] . ",2)'>Відхилити</button>
</td>
</tr>";
}
echo "</table>";