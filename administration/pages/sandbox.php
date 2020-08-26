<script type="text/javascript">
function test () {
            var ajax_function = "verify_cist_timetable";
            var verify_date = "15 .05.18";
            var verify_pair = "4";
            var teacher_id = "86";
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    verify_date: verify_date,
                    verify_pair: verify_pair,
                    teacher_id: teacher_id
                },
                success: function (data) {
                    if (data != "OK") {
                        swal({
                            title: "Увага!",
                            text: data,
                            type: "warning",
                        });
                    }else if (data == "OK"){
                        swal({
                            title: "",
                            text: "Події на CIST на даний період відсутні",
                            type: "success",
                        });
                    }
                }
            });
        }
</script>
<button class="btn btn-success" onclick="test()" id="submit">TEST</button>