<script type="text/javascript">
    function faculty_chose() {
        var ajax_function = "get_departments";
        var faculty_id = $("select[name=faculties]").val();
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                faculty_id: faculty_id
            },
            success: function (data) {
                $("#departments").html(data);
            }
        });
    }
    function teacher_chose() {
        var ajax_function = "get_teachers";
        var department_id = $("select[name=departments]").val();
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                department_id: department_id
            },
            success: function (data) {
                $("#teachers").html(data);
            }
        });
    }
    function getCISTId() {
        var teacher_id = $("select[name=teachers]").val();
        $("#CIST_BLOCK").show();
        $("#CIST_ID").html("<b>CIST ID:</b> "+teacher_id);
    }
    function synchronize() {
        var ajax_function = "synchronize_cist";
        var teacher_id = $("select[name=teachers]").val();
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                t_uid: <?php echo $_SESSION['t_uid']; ?>,
                teacher_id: teacher_id
            },
            success: function (data) {
                if (data == "ERROR") {
                    swal({
                        title: "Помилка",
                        text: "Розклад не синхронізовано. Спробуйте ще раз.",
                        type: "error",
                    });
                } else if (data == "OK") {
                    swal({
                        title: "Успіх",
                        text: "Розклад успішно снхронізовано",
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
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Синхронізація розкладу з CIST</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <fieldset class="content-group">
            <div class="form-group">
                <label>Виберіть ваш факультет</label>
                <select onchange="faculty_chose()" name="faculties" class='select-search'>
                    <?php
                    $faculties = getNureFaculties();
                    $faculty_count = count($faculties['university']['faculties']) - 1;
                    while ($faculty_count >= 0) { ?>
                        <option value="<?php echo $faculties['university']['faculties'][$faculty_count]['id']?>"><?php echo $faculties['university']['faculties'][$faculty_count]['full_name']?></option>
                        <?php
                        $faculty_count--;
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Виберіть вашу кафедру</label>
                <select id="departments" name="departments" onchange="teacher_chose()" class='select-search'>

                </select>
            </div>
            <div class="form-group">
                <label>Виберіть ваш ПІБ викладача</label>
                <select id="teachers" name="teachers" onchange="getCISTId()" class='select-search'>
                </select>
            </div>
            <div class="col-xs-12">
                <div class="alert alert-success alert-styled-left" id="CIST_BLOCK" hidden>
                    <span id="CIST_ID" class="text-semibold"></span>
                    <button class="btn btn-block btn-xs btn-success" onclick="synchronize()">Синхронізувати</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>
