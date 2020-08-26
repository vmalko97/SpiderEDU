<script type="text/javascript">
    $(function () {
        $("#submit").click(function () {
            var ajax_function = "add_auditory";
            var auditory = $("select[name=auditory]").val();
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    auditory: auditory
                },
                success: function (data) {
                    if (data == "ERROR") {
                        swal({
                            title: "Помилка",
                            text: "Аудиторію не додано",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Аудиторію додано успішно",
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
        });
    });
</script>
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Додавання аудиторії</h6>
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
                    <label>Виберіть аудиторію (CIST)</label>
                    <?php
                    $auditories = getNureAuditories();
                    $aud_count = count($auditories);
                    echo "<select id='auditory' name='auditory' class='select-search'>";
                    while ($aud_count > 0) {
                        echo "<option value='" . $auditories[$aud_count]['id'] . "@" . $auditories[$aud_count]['short_name'] . "'>" . $auditories[$aud_count]['short_name'] . "</option>";
                        $aud_count--;
                    }
                    echo "</select>";
                    ?>
                </div>
                <button name="submit" id ="submit" class="btn btn-primary btn-block">Додати</button>
        </fieldset>
    </div>
</div>
