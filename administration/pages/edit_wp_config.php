<script type="text/javascript">
    $(function () {
        $("#submit").click(function () {
            var ajax_function = "edit_wp_config";
            var wp_url = $("input[name=wp_url]").val();
            var wp_db_host = $("input[name=wp_db_host]").val();
            var wp_db_user = $("input[name=wp_db_user]").val();
            var wp_db_password = $("input[name=wp_db_password]").val();
            var wp_db_name = $("input[name=wp_db_name]").val();
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    wp_url:wp_url,
                    wp_db_host:wp_db_host,
                    wp_db_user:wp_db_user,
                    wp_db_password:wp_db_password,
                    wp_db_name:wp_db_name
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
        <h6 class="panel-title">Налаштування конфігурації WordPress блогу</h6>
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
                        <label class="control-label">URL блогу</label>
                        <input type="text" name="wp_url" class="form-control" value="<?php echo getWPURL(); ?>"
                               placeholder="URL блогу (Наприклад http://example.com/)"/>
                        <label class="control-label">Хост бази даних</label>
                        <input type="text" name="wp_db_host" class="form-control" value="<?php echo getWPDbHost(); ?>"
                               placeholder="Хост бази даних"/>
                        <label class="control-label">Ім'я користувача бази даних</label>
                        <input type="text" name="wp_db_user" class="form-control" value="<?php echo getWPDbUser(); ?>"
                               placeholder="Ім'я користувача бази даних"/>
                        <label class="control-label">Пароль бази даних</label>
                        <input type="password" name="wp_db_password" class="form-control" value="<?php echo getWPDbPassword(); ?>"
                               placeholder="Пароль бази даних"/>
                        <label class="control-label">Назва бази даних</label>
                        <input type="text" name="wp_db_name" class="form-control" value="<?php echo getWPDbName(); ?>"
                               placeholder="Назва бази даних"/>
                    </div>
                    <button type="button" id="submit" class="btn btn-primary btn-block">Зберегти</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>