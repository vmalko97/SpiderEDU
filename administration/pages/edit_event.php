<?php
if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET,'id');
    ?>
<script type="text/javascript">
    $(function () {
        $("#submit").click(function () {
            var ajax_function = "edit_event";
            var id = "<?php echo $id;?>";
            var event_name = $("input[name=event_name]").val();
            var description = $("textarea[name=description]").val();
            var type = $("select[name=type]").val();
            var price = $("input[name=price]").val();
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    id:id,
                    event_name:  event_name,
                    description: description,
                    type: type,
                    price: price,
                },
                success: function (data) {
                    if (data == "ERROR") {
                        swal({
                            title: "Помилка",
                            text: "Подію не змінено",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Подію відредаговано успішно",
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
        <h6 class="panel-title">Редагування події</h6>
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
                <?php
                $owner_id = getEventOwnerId($id);
                $owner = getEventOwnerNameById($owner_id);
                $query = getEventDataById($id);
                while ($event = mysqli_fetch_array($query)){?>
                <label>Назва події</label>
                <input type="text" name="event_name" class="form-control" value="<?php echo $event['event_name'];?>" placeholder="Назва події" required>
                <label>Опис події</label>
                <textarea maxlength="300" rows="5" cols="5" name="description" class="form-control" placeholder="Опис події"><?php echo $event['description'];?></textarea>
                <label>Тип</label>
                <select name="type" class="form-control">
                    <option value="free" <?php if($event['type'] == "pay"){ echo "selected"; } ?> >Безкоштовна</option>
                    <option value="pay" <?php if($event['type'] == "pay"){ echo "selected"; } ?> >Платна</option>
                </select>
                <label>Ціна</label>
                <input type="number" value="<?php echo $event['price'];?>" name="price" placeholder="Ціна" class="form-control" required/>
                <label>Власник</label>
                <input type="text" value="<?php echo $owner;?>" class="form-control" disabled/>
<?php } ?>
            </div>
            <button name="submit" id ="submit" class="btn btn-primary btn-block">Зберегти</button>
        </fieldset>
    </div>
</div>
<?php } ?>