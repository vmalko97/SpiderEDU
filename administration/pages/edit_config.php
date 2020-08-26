<script type="text/javascript">
    $(function () {
    $("#submit").click(function () {
        var ajax_function = "edit_config";
        var app_name = $("input[name=app_name]").val();
        var tg_bot_api_key = $("input[name=tg_bot_api_key]").val();
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                app_name: app_name,
                tg_bot_api_key: tg_bot_api_key
            },
            success: function (data) {
                if (data == "ERROR") {
                    swal({
                        title: "Помилка",
                        text: "Конфігурацію не змінено",
                        type: "error",
                    });
                } else if (data == "OK") {
                    swal({
                        title: "Успіх",
                        text: "Конфігурацію успішно змінено",
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
        <h6 class="panel-title">Налаштування конфігурації</h6>
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
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Назва додатку</label>
                            <input type="text" name="app_name" class="form-control" value="<?php echo getAppName(); ?>"
                                   placeholder="Назва додатку"/>
                            <label class="control-label">API-ключ Telegram бота</label>
                            <input type="text" name="tg_bot_api_key" class="form-control" value="<?php echo getTelegramBotAPIKey(); ?>"
                                   placeholder="API-ключ Telegram бота"/>
                            <label class="control-label">Дата останнього оновлення розкладу аудиторій
                                (CIST)</label>
                            <input type="text" disabled="disabled" class="form-control"
                                   value="<?php echo getCistTimetableUpdateTime(); ?>"
                                   placeholder="Дата останнього оновлення"/>
                        </div>
                        <button type="button" id="submit" class="btn btn-primary btn-block">Зберегти</button>
                    </div>
                </div>
            </fieldset>
    </div>
</div>