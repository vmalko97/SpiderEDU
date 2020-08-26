<?php
    $query = getStudentDataById($_SESSION['uid']);
    $id = $_SESSION['uid'];
    ?>
    <script type="text/javascript">
        $(function () {
            $("#submit").click(function () {
                var ajax_function = "edit_student_profile";
                var id = "<?php echo $id;?>";
                var full_name = $("input[name=full_name]").val();
                var password = $("input[name=password]").val();
                var study_place = $("input[name=study_place]").val();
                var working_place = $("input[name=working_place]").val();
                var telephone = $("input[name=telephone]").val();
                var email = $("input[name=email]").val();
                var skype = $("input[name=skype]").val();
                var telegram = $("input[name=telegram]").val();
                var address = $("input[name=address]").val();
                $.ajax({
                    url: 'resources/system/ajax_functions.php',
                    type: "POST",
                    data: {
                        ajax_function: ajax_function,
                        id: id,
                        full_name: full_name,
                        password:password,
                        study_place: study_place,
                        working_place: working_place,
                        telephone: telephone,
                        email: email,
                        skype: skype,
                        telegram: telegram,
                        address: address,
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
                                text: "Інформацію успішно змінено",
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
                        <?php while ($student = mysqli_fetch_array($query)){?>
                        <div class="form-group">
                            <label class="control-label">ПІБ</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $student['full_name']?>"
                                   placeholder="ПІБ"/>
                            <label class="control-label">Пароль</label>
                            <input type="password" name="password" class="form-control" value=""
                                   placeholder="Заповніть якщо хочете змінити пароль"/>
                            <label class="control-label">Місце навчання</label>
                            <input type="text" name="study_place" class="form-control" value="<?php echo $student['study_place']?>"
                                   placeholder="Місце навчання"/>
                            <label class="control-label">Місце роботи</label>
                            <input type="text" name="working_place" class="form-control" value="<?php echo htmlspecialchars($student['working_place'])?>"
                                   placeholder="Місце роботи"/>
                            <label class="control-label">Телефон в міжнародному форматі (без "+")</label>
                            <input type="text" name="telephone" class="form-control" value="<?php echo $student['telephone']?>"
                                   placeholder="Телефон"/>
                            <label class="control-label">E-Mail</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $student['email']?>"
                                   placeholder="E-Mail"/>
                            <label class="control-label">Skype</label>
                            <input type="text" name="skype" class="form-control" value="<?php echo $student['skype']?>"
                                   placeholder="Skype"/>
                            <label class="control-label">Telegram</label>
                            <input type="text" name="telegram" class="form-control" value="<?php echo $student['telegram']?>"
                                   placeholder="Telegram"/>
                            <label class="control-label">Адреса</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $student['address']?>"
                                   placeholder="Адреса"/>
                            <?php } ?>
                        </div>
                        <button type="button" id="submit" class="btn btn-primary btn-block">Зберегти</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>