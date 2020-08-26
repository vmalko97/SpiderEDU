<script type="text/javascript">
    function delete_event(id) {
        var ajax_function = "delete_event";
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                id: id
            },
            success: function (data) {
                if (data == "ERROR") {
                    swal({
                        title: "Помилка",
                        text: "Подію не видалено з системи",
                        type: "error",
                    });
                } else if (data == "OK") {
                    swal({
                        title: "Успіх",
                        text: "Подію успішно видалено з системи",
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
<div class="row">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Список подій</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="bg bg-grey-800">
                    <th width="10%">ID</th>
                    <th width="20%">Назва</th>
                    <th width="50%">Опис</th>
                    <th width="30%">Дії</th>
                </tr>
                </thead>
                <?php
                $events_query = getEvents();

                while ($events = mysqli_fetch_array($events_query)) {
                    ?>
                    <tr>
                        <td><?php echo $events['id']; ?></td>
                        <td><?php echo $events['event_name']; ?></td>
                        <td><?php echo $events['description']; ?></td>
                        <td>
                            <a class="btn btn-info" data-toggle="modal"
                               data-target="#info<?php echo $events['id']; ?>"><span
                                        class="icon icon-info22"></span></a>
                            <div id="info<?php echo $events['id']; ?>" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title">Інформація про подію</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">ID події</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $events['id']; ?>"
                                                               class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Назва події</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $events['event_name']; ?>"
                                                               class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Опис</label>
                                                    <div class="col-sm-9">
                                                    <textarea rows="5" cols="5" class="form-control"
                                                              disabled><?php echo $events['description']; ?> </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Тип</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php if ($events['type'] == 'free') {
                                                            echo 'Безкоштовна';
                                                        } elseif ($events['type'] == 'pay') {
                                                            echo "Платна";
                                                        } ?>"
                                                               class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Ціна</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $events['price']; ?>"
                                                               class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Організатор</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php if ($events['owner'] != NULL) {
                                                            echo $events['owner'];
                                                        } else {
                                                            echo "Адміністратор";
                                                        }; ?>" class="form-control" disabled/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Закрити
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="?page=edit_event&id=<?php echo $events['id']; ?>" class="btn btn-warning"><span
                                        class="icon icon-pen6"></a>
                            <a onclick="delete_event(<?php echo $events['id']; ?>)" class="btn btn-danger"><span
                                        class="icon icon-cancel-circle2"></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>