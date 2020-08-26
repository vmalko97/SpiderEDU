<script type="text/javascript">

    $(function () {

        $(".steps-basic").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                finish: 'Додати'
            },
            onFinished: function (event, currentIndex) {
                var ajax_function = "add_teacher";
                var login = $("input[name=login]").val();
                var password = $("input[name=password]").val();
                var full_name = $("input[name=full_name]").val();
                var education = $("input[name=education]").val();
                var job_place = $("input[name=job_place]").val();
                var position = $("input[name=position]").val();
                var telephone = $("input[name=telephone]").val();
                var email = $("input[name=email]").val();
                var skype = $("input[name=skype]").val();
                var telegram = $("input[name=telegram]").val();
                var address = $("input[name=address]").val();
                var status = "teacher";
                $.ajax({
                    url: '../resources/system/ajax_functions.php',
                    type: "POST",
                    data: {
                        ajax_function: ajax_function,
                        login: login,
                        password: password,
                        full_name: full_name,
                        education: education,
                        job_place: job_place,
                        position: position,
                        telephone: telephone,
                        email: email,
                        skype: skype,
                        telegram: telegram,
                        address: address,
                        status:status
                    },
                    success: function (data) {
                        if (data == "ERROR") {
                            swal({
                                title: "Помилка",
                                text: "Викладача не додано",
                                type: "error",
                            });
                        } else if (data == "OK") {
                            swal({
                                title: "Успіх",
                                text: "Викладача успішно додано",
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
        });

    });

</script>
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Додавання викладача</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <form class="steps-basic" method="post" action="?page=add_teacher">
        <h6>Реєстраційні дані</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Логін <span class="text text-danger">*</span></label>
                        <input type="text" name="login" class="form-control" placeholder="Логін" required>
                    </div>
                </div>
            </div>
        </fieldset>

        <h6>Персональні дані</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ПІБ викладача <span class="text text-danger">*</span></label>
                        <input type="text" name="full_name" class="form-control" placeholder="ПІБ Викладача" required>
                        <label>Освіта <span class="text text-danger">*</span></label>
                        <input type="text" name="education" class="form-control" placeholder="Освіта" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Місце роботи <span class="text text-danger">*</span></label>
                        <input type="text" name="job_place" class="form-control" placeholder="Місце роботи" required>
                        <label>Посада <span class="text text-danger">*</span></label>
                        <input type="text" name="position" class="form-control" placeholder="Посада" required>
                    </div>
                </div>
            </div>
        </fieldset>
        <h6>Контактні дані</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Телефон <span class="text text-danger">*</span></label>
                        <input type="text" name="telephone" class="form-control" placeholder="Телефон" required>
                        <label>E-Mail <span class="text text-danger">*</span></label>
                        <input type="text" name="email" class="form-control" placeholder="E-Mail" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Skype</label>
                        <input type="text" name="skype" class="form-control" placeholder="Skype">
                        <label>Telegram</label>
                        <input type="text" name="telegram" class="form-control" placeholder="Telegram">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Домашня адреса <span class="text text-danger">*</span></label>
                        <input type="text" name="address" class="form-control" placeholder="Домашня адреса" required>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>

