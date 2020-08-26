<script type="text/javascript">
    $(function () {
        $("#submit").click(function () {
            var ajax_function = "edit_admin_profile";
            var login = $("input[name=login]").val();
            var password = $("input[name=password]").val();
            var telephone = $("input[name=telephone]").val();
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    login: login,
                    password:password,
                    telephone: telephone
                },
                success: function (data) {
                    if (data == "ERROR") {
                        swal({
                            title: "Помилка",
                            text: "Інформацію не змінено",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Інформацію успішно оновлено",
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
        <h6 class="panel-title">Редагування профілю</h6>
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
                        <?php
                        $query = getSuperAdministratorData();
                        while ($super_admin = mysqli_fetch_array($query)){
                        ?>
                        <label class="control-label">Логін</label>
                        <input type="text" name="login" class="form-control" value="<?php echo $super_admin['login']; ?>"
                               placeholder="Назва додатку"/>
                        <label class="control-label">Пароль</label>
                        <input type="password" name="password" class="form-control" value=""
                               placeholder="Заповніть якщо хочете змінити пароль"/>
                        <label class="control-label">Телефон в міжнародному форматі (без "+")</label>
                        <input type="text" name="telephone" class="form-control"
                               value="<?php echo $super_admin['telephone'];?>"
                               placeholder="Телефон в міжнародному форматі (без "+")"/>
                        <?php } ?>
                    </div>
                    <button type="button" id="submit" class="btn btn-primary btn-block">Зберегти</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>