<script type="text/javascript">
    $(function () {
        $("#submit").click(function () {
            var ajax_function = "add_event";
            var event_name = $("input[name=event_name]").val();
            var description = $("textarea[name=description]").val();
            var type = $("select[name=type]").val();
            var price = $("input[name=price]").val();
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    event_name:  event_name,
                    description: description,
                    type: type,
                    price: price,
                    owner_id: <?php echo $_SESSION['t_uid'];?>,
                    status: 'unmoderated'
                },
                success: function (data) {
                    if (data == "ERROR") {
                        swal({
                            title: "Помилка",
                            text: "Подію не додано",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Подію додано успішно",
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
        <h6 class="panel-title">Додавання події</h6>
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
                <label>Назва події</label>
                <input type="text" name="event_name" class="form-control" placeholder="Назва події" required>
                <label>Опис події</label>
                <textarea maxlength="300" rows="5" cols="5" name="description" class="form-control" placeholder="Опис події"></textarea>
                <label>Тип</label>
                <select name="type" class="form-control">
                    <option value="free">Безкоштовна</option>
                    <option value="pay">Платна</option>
                </select>
                <label>Ціна</label>
                <input type="number" value="0" name="price" placeholder="Ціна" class="form-control" required/>

            </div>
            <button name="submit" id ="submit" class="btn btn-primary btn-block">Додати</button>
        </fieldset>
    </div>
</div>
